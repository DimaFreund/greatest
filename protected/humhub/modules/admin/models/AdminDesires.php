<?php


namespace humhub\modules\admin\models;

use Yii;

/**
 * This is the model class for table "admin_desires".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $content
 * @property string $date
 * @property string $image
 * @property integer $status
 */
class AdminDesires extends \yii\db\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'admin_desires';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['title', 'description', 'content'], 'required'],
			[['title', 'description', 'content'], 'string'],
			[['date'], 'date', 'format'=>'php:Y-m-d'],
			[['date'], 'default', 'value' => date('Y-m-d')],
			[['title', 'image'], 'string', 'max' => 255],
			[['status'], 'integer'],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'title' => 'Title',
			'description' => 'Description',
			'content' => 'Content',
			'date' => 'Date',
			'image' => 'Image',
			'status' => 'Status',
		];
	}

	public static function getStatusCaption($status)
	{
		return $status ? 'publish' : 'no publish';
	}

	public  static function getImageElement($imageName)
	{
		return  '<img src="/uploads/admin_files/'.$imageName.'" alt="'.$imageName.'">';
	}
}
