<?php

namespace humhub\models;


use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class MultiUploadImage extends  Model {


	public $slides;
	private $arrayslides;

	public function rules()
	{
		return [
			[['slides'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg', 'maxFiles' => 14],
		];
	}

	public function upload()
	{
		if ($this->validate()) {
			foreach ($this->slides as $file) {
				$file->saveAs('uploads/admin_files/' . $file->baseName . '.' . $file->extension);
				$this->arrayslides[] = '/uploads/admin_files/'.$file->name;
			}
			return $this->arrayslides;
		} else {
			return false;
		}
	}
}



