<?php

namespace humhub\modules\content\models;

use humhub\components\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "category".
 *
 *
 * The followings are the available columns in table 'category':
 * @property integer $id
 * @property string $name
 * @property integer $object_model
 */


class Category extends ActiveRecord
{

	public $default_language;

	public $filter = null;

	public static $object = ['blog', 'gallery', 'space'];

	public static function tableName()
	{
		return 'category';
	}

	public function rules()
	{
		return [
			[['id'], 'integer'],
			[['name', 'object_model'], 'string'],
			['filter', 'each', 'rule' => ['integer']]
		];
	}

	public function getAllCurrentLanguage($lan, $object_model)
	{
		$categoryModule = self::find()->where(['object_model' => $object_model])->all();

		foreach($categoryModule as $key => $item)
		{
			$name = $item->name;
			$name = unserialize($name);

			if(isset($name[$lan]))
			{
				$item->name = $name[$lan];
			}
			elseif(isset($name['en']))
			{
				$item->name = $name['en'];
			}
			else
			{
				unset( $categoryModule[ $key ] );
			}
		}
		$categoryModule = ArrayHelper::map($categoryModule,'id','name');

		asort($categoryModule);

		return $categoryModule;

	}

	public static function addFilter($object) {

		$model = new Category();
		if($model->load(\Yii::$app->request->get()) && $model->validate()) {
			if($model->filter) {
				$object->andWhere( [ 'category' => $model->filter ] );
			}
		}
	}

}