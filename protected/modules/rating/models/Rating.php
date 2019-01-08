<?php

namespace humhub\modules\rating\models;


use humhub\modules\content\components\ContentContainerActiveRecord;
use Yii;

class Rating extends ContentContainerActiveRecord {

	public static function tableName() {
		return 'rating';
	}

	public function rules()
	{
		return [
			[['rating'], 'integer', 'min' => 0, 'max' => 5],
		];
	}

	public function behaviors()
	{
		return [
			[
				'class' => \humhub\components\behaviors\PolymorphicRelation::className(),
				'mustBeInstanceOf' => [
					\yii\db\ActiveRecord::className(),
				]
			]
		];
	}

	public static function getCurrentUserVoice($desire_id)
	{
		return self::findOne(array('desire_id' => $desire_id, 'created_by' => Yii::$app->user->id));
	}

	public static function getRatingDesire($desire_id)
	{
		$voices = self::findAll(['desire_id' => $desire_id]);

		$result['count'] = count($voices);
		$result['rating'] = 0;

		$sum = 0;

		foreach ($voices as $voice) {
			$sum+= $voice->rating;
		}

		if($result['count'] > 0)
			$result['rating'] = $sum/$result['count'];

		return $result;
	}

}