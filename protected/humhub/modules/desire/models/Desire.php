<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2016 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\desire\models;

use humhub\modules\desire\activities\GreatestDesireUpdate;
use humhub\modules\desire\notifications\NewDesire;
use humhub\modules\friendship\models\Friendship;
use humhub\modules\tags\models\Tags;
use humhub\modules\tags\models\TagsDesire;
use Yii;
use humhub\modules\content\components\ContentActiveRecord;
use humhub\modules\search\interfaces\Searchable;
use humhub\modules\user\models\User;
use yii\data\Pagination;
use yii\db\ActiveQuery;
use yii\db\Query;

/**
 * This is the model class for table "desire".
 *
 * @property integer $id
 * @property string $message_2trash
 * @property string $message
 * @property string $url
 * @property string $greatest
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 */
class Desire extends ContentActiveRecord implements Searchable
{

    /**
     * @inheritdoc
     */
    public $wallEntryClass = 'humhub\modules\desire\widgets\WallEntry';

	public $verifyCode;

	public $agreePrivacyPolicy;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'desire';
    }

	public static function objectName()
	{
		return Yii::t('base','desire');
	}

    /**
     * @inheritdoc
     */
    public function rules()
    {
    	$rules = [
		    [['title'], 'required'],
		    [['title'], 'string', 'min' => 5, 'max' => 200],
		    [['message'], 'string', 'max' => 8192],
		    [['greatest'], 'integer'],
		    [['url'], 'string', 'max' => 255]
	    ];
    	if(Yii::$app->user->isGuest) {
    		$rules = array_merge($rules,[
			    [['verifyCode'], \himiklab\yii2\recaptcha\ReCaptchaValidator::className(), 'secret' => '6Lcs6ocUAAAAAELD0dVC1Kw5vFmufLK2I4xxDC5t'],
				[['agreePrivacyPolicy'], 'required', 'requiredValue' => 1, 'message' => 'You must agree to our terms']
		     ]);
	    }
        return $rules;
    }

    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        // Prebuild Previews for URLs in Message
        \humhub\models\UrlOembed::preload($this->message);

        // Check if Desire Contains an Url
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

		if($insert) {
			$currentUser = Yii::$app->user->getIdentity();
			$friends = Friendship::getFriendsQuery($currentUser)->all();
			foreach ($friends as $friend) {
				NewDesire::instance()->from( $currentUser )->about( $this )->send( $friend );
			}
		}
        return true;
    }

    /**
     * @inheritdoc
     */
    public function getContentName()
    {
        return Yii::t('DesireModule.models_Desire', 'desire');
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
            'tags' => $this->getTagsString(),
            'url' => $this->url,
            'user' => $this->getDesireAuthorName()
        );

        $this->trigger(self::EVENT_SEARCH_ADD, new \humhub\modules\search\events\SearchAddEvent($attributes));

        return $attributes;
    }

    /**
     * @return string
     */
    private function getDesireAuthorName()
    {
        $user = User::findOne(['id' => $this->created_by]);

        if ($user !== null && $user->isActive()) {
            return $user->getDisplayName();
        }

        return '';
    }

	public function getUser()
	{
		return $this->hasOne(User::className(), ['id' => 'created_by']);
	}

	public function attributeLabels()
	{
		return [
			'title' => Yii::t('base', 'My Desire is') . '..',
			'message' => Yii::t('base', 'Description'),
			'greatest' => Yii::t('DesireModule.forms_create', 'Make it Greatest!'),

		];
	}

	public static function getAll($pageSize = 6, $offset = 0)
	{
		// build a DB query to get all articles
		$query = Desire::find();

		// get the total number of articles (but do not fetch the article data yet)
		$count = $query->count();

		// limit the query using the pagination and retrieve the articles
		$articles = $query->offset($offset)
		                  ->limit($pageSize)
		                  ->all();

		$data['articles'] = $articles;
		$data['count'] = $count;

		return $data;
	}

	public static function getSortParameters() {
    	$parametersSort = parent::getSortParameters();
    	unset($parametersSort['like']);
    	$parametersSort['rating'] = 'Biggest Rating';
		return $parametersSort;
	}

	public static function sortByParameters( ActiveQuery $query, $param ) {
		$query = parent::sortByParameters( $query, $param );
		if($param == 'rating') {
			$subQuery = (new Query())->from('rating')->select('desire_id, COUNT(rating) as count, avg(rating) as avg')->groupBy('desire_id');
			$query->leftJoin(['rating' => $subQuery],'rating.desire_id = '.static::tableName().'.id');
			$query->orderBy('avg DESC, count DESC');
		}

		return $query;
	}

	public function getTags()
	{
		return $this->hasMany(Tags::className(), ['id' => 'tags_id'])
		            ->viaTable('tags_relationship', ['desire_id' => 'id']);
	}

	public function getTagsString() {
		$result = '';
		foreach ($this->tags as $tag) {
			$result .= $tag->title . ' ';
		}
		return $result;
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

	public static function getGreatestDesire(User $user)
	{
		$id_desire = $user->greatest_desire;

		if(empty($id_desire) || $id_desire === null) {
			$admin = User::find(['id' => 1])->one();
			$id_desire = $admin->greatest_desire;
		}
		$greatest_desire = self::findOne(['id' => $id_desire]);

		return $greatest_desire;
	}

	public function saveGreatestDesire($greatest = false)
	{
		if($greatest || $this->checkGreatestDesire()) {
			$user = User::findOne(['id' => $this->created_by]);
			$user->greatest_desire = $this->id;
			$user->save();
			if(!$this->isNewRecord) {
				GreatestDesireUpdate::instance()->from($user)->about($this)->save();
			}
		}
	}

	public function checkGreatestDesire()
	{
		$desire = Yii::$app->request->post('Desire');
		if($desire['greatest'] == 1) {
			return true;
		}
	}

	public function clearCurrentTags()
	{
		TagsDesire::deleteAll(['desire_id'=>$this->id]);
	}

	public function getSource()
	{
		return $this;
	}

}
