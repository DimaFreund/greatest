<?php
namespace humhub\modules\tags\models;

use humhub\components\ActiveRecord;
use humhub\modules\desire\models\Desire;

class TagsRelationship extends ActiveRecord
{
	/**
	 * @inheritdoc
	 */

	public $weight;

	public static function tableName()
	{
		return 'tags_relationship';
	}


	public function getTags()
	{
		return $this->hasOne(Tags::className(), ['id' => 'tags_id']);
	}

	public static function getPopularTags($limit)
	{
		$tags = self::find()
		            ->select(['*, COUNT(tags_id) AS weight'])
		            ->groupBy('tags_id')
					->orderBy('weight DESC')
					->limit($limit)
		            ->all();
		return $tags;
	}


}