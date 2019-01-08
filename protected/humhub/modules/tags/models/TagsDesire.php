<?php
namespace humhub\modules\tags\models;

use humhub\modules\content\components\ContentAddonActiveRecord;

/**
 * This is the model class for table "article_tag".
 *
 * @property integer $id
 * @property integer $article_id
 * @property integer $tag_id
 *
 * @property Tag $tag
 * @property Article $article
 */
class TagsDesire extends ContentAddonActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'tags_relationship';
	}
	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['article_id', 'tag_id'], 'integer'],
//			[['tag_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tag::className(), 'targetAttribute' => ['tag_id' => 'id']],
//			[['article_id'], 'exist', 'skipOnError' => true, 'targetClass' => Article::className(), 'targetAttribute' => ['article_id' => 'id']],
		];
	}
	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'desire_id' => 'Desire ID',
			'tags_id' => 'Tags ID',
		];
	}
	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getTag()
	{
		return $this->hasOne(Tag::className(), ['id' => 'tags_id']);
	}
	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getArticle()
	{
		return $this->hasOne(Article::className(), ['id' => 'desire_id']);
	}
}