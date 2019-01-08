<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2016 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\news\models;

use humhub\modules\content\models\Category;
use humhub\modules\tags\models\Tags;
use humhub\modules\tags\models\TagsDesire;
use Yii;
use humhub\modules\content\components\ContentActiveRecord;
use humhub\modules\search\interfaces\Searchable;
use humhub\modules\user\models\User;
use yii\data\Pagination;

/**
 * This is the model class for table "news".
 *
 * @property integer $id
 * @property string $message_2trash
 * @property string $message
 * @property string $url
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 */
class News extends ContentActiveRecord implements Searchable
{

    /**
     * @inheritdoc
     */
    public $wallEntryClass = 'humhub\modules\news\widgets\WallEntry';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'news';
    }

	public static function objectName()
	{
		return 'news post';
	}

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['message', 'title'], 'required'],
	        [['category'], 'integer'],
            [['message'], 'string'],
            [['url'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        // Prebuild Previews for URLs in Message
        \humhub\models\UrlOembed::preload($this->message);

        // Check if News Contains an Url
        if (preg_match('/http(.*?)(\s|$)/i', $this->message)) {
            // Set Filter Flag
            $this->url = 1;
        }

        return parent::beforeSave($insert);
    }

    /**
     * @inheritdoc
     */
    public function afterSave($insert, $changedAttributes)
    {

        parent::afterSave($insert, $changedAttributes);

        // Handle mentioned users
        \humhub\modules\user\models\Mentioning::parse($this, $this->message);

        return true;
    }

    /**
     * @inheritdoc
     */
    public function getContentName()
    {
        return Yii::t('NewsModule.models_News', 'news');
    }

    public function getLabels($result = [], $includeContentName = true)
    {
        return parent::getLabels($result, false);
    }

    /**
     * @inheritdoc
     */
    public function getContentDescription()
    {
        return $this->message;
    }

    /**
     * @inheritdoc
     */
    public function getSearchAttributes()
    {
        $attributes = array(
            'message' => $this->message,
            'url' => $this->url,
            'user' => $this->getNewsAuthorName()
        );

        $this->trigger(self::EVENT_SEARCH_ADD, new \humhub\modules\search\events\SearchAddEvent($attributes));

        return $attributes;
    }

    /**
     * @return string
     */
    private function getNewsAuthorName()
    {
        $user = User::findOne(['id' => $this->created_by]);

        if ($user !== null && $user->isActive()) {
            return $user->getDisplayName();
        }

        return '';
    }

	public function attributeLabels()
	{
		return [
			'title' => Yii::t('NewsModule.forms_create', 'My Greatest News is...'),
			'message' => Yii::t('NewsModule.forms_create', 'Description'),

		];
	}

	public static function getAll($pageSize = 6)
	{
		// build a DB query to get all articles
		$query = News::find();

		// get the total number of articles (but do not fetch the article data yet)
		$count = $query->count();

		// create a pagination object with the total count
		$pagination = new Pagination(['totalCount' => $count, 'pageSize'=>$pageSize]);

		// limit the query using the pagination and retrieve the articles
		$articles = $query->offset($pagination->offset);
		                  $query->limit($pagination->limit);
		                  $query->all();

		$data['articles'] = $articles;
		$data['pagination'] = $pagination;
		$data['count'] = $count;

		return $data;
	}

	public static function getAllPublic($offset = 0)
	{
		$query = self::find();
		$query->leftJoin('content', 'content.object_id = news.id');
		$query->where(['content.visibility' => 1]);
		$query->andWhere(['content.object_model' => self::className()]);
		$query->limit(10);
		$query->offset($offset);
		$query->orderBy('created_at DESC');

		$data['count'] = $query->count();
		$data['news'] = $query->all();

		return $data;
	}

	public function getTags()
	{
		return $this->hasMany(Tags::className(), ['id' => 'tags_id'])
		            ->viaTable('tags_relationship', ['desire_id' => 'id']);
	}

	public function saveTags()
	{
		$this->clearCurrentTags();

		$tags = explode(',', Yii::$app->request->post('tags'));

		foreach($tags as $tag_title)
		{
			$tag = Tags::findOne([
				'title' => $tag_title
			]);
			if($tag == null){
				$tag = new Tags();
				$tag->title = $tag_title;
				$tag->save();
			}
			$this->link('tags', $tag);
		}
	}

	public function saveFiles()
	{
		$files = Yii::$app->request->post( 'fileList' );
		$this->fileManager->attach( $files );
	}

	public function clearCurrentTags()
	{
		TagsDesire::deleteAll(['desire_id'=>$this->id]);
	}

}
