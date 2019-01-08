<?php

namespace humhub\models;


use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class UploadOneImage extends  Model {

	public $image;

	public $pathAdminFiles = 'uploads/admin_files/';

	public function upload($form, $atribute)
	{
		$file = UploadedFile::getInstance( $form, $atribute );

		if(isset($file)) {
			$file->saveAs( $this->getPath() . $file->name );
			$form->$atribute = $file->name;
		}
	}

	public function getPath()
	{
		return Yii::getAlias('@web') . $this->pathAdminFiles;
	}
}