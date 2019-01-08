<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2016 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\user\widgets;

use humhub\modules\user\controllers\ImageController;
use Yii;


class UserPhotoControl extends \yii\base\Widget
{

	public $user;


	public function run()
	{

		$imageController = new ImageController('image-controller', null, ['user' => $this->user]);

		return $this->render("userPhotoControl", [
			'user' => $this->user,
			'allowModifyProfileImage' => $imageController->allowModifyProfileImage,
			]);
	}

}
