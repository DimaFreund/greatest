<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2015 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\gallery\controllers;

use humhub\modules\gallery\models\Media;

class GalleryItemController extends BaseController {
	public function actionIndex($id) {

		$model = Media::findOne($id);

		return $this->render('index', ['model' => $model]);
	}


	protected function getOpenGallery( $openGalleryId = null ) {
		// TODO: Implement getOpenGallery() method.
	}


	protected function renderGallery( $ajax = false, $openGalleryId = null ) {
		// TODO: Implement renderGallery() method.
	}
}