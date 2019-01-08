<?php

namespace humhub\modules\admin\models;

use Yii;

/**
 * This is the model class for table "guest_question".
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $subject
 * @property string $text
 * @property string $date
 */
class GuestQuestion extends \yii\db\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'guest_question';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['text'], 'string'],
			[['name','email'], 'required'],
			[['email'], 'email'],
			[['date'], 'default', 'value' => date('Y-m-d')],
			[['name', 'email', 'subject'], 'string', 'max' => 255],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'name' => 'Name',
			'email' => 'Email',
			'subject' => 'Subject',
			'text' => 'Text',
			'date' => 'Date',
		];
	}
}
