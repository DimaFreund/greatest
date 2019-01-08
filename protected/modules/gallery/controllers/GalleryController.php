<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2015 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\gallery\controllers;

use humhub\components\GeneralController;
use humhub\components\Response;
use humhub\modules\content\models\Category;
use humhub\modules\file\models\File;
use humhub\modules\gallery\models\CustomGallery;
use humhub\modules\gallery\models\Media;
use Yii;
use yii\helpers\Url;


class GalleryController extends GeneralController
{


	public function actionIndex()
	{


		$public_photos = Media::getPublicPhotos();

		$public_albums = CustomGallery::getPublicAlbums();

		$category = new Category();
		$category = $category->getAllCurrentLanguage(Yii::$app->language, 'gallery');

		return $this->render('index', [
			'photos' => $public_photos['photos'],
			'countPhotos' => $public_photos['count'],
			'ajaxUrl' => Url::to('/gallery/gallery/ajax-photo-list'). '?',
			'ajaxUrlAlbums' => Url::to('/gallery/gallery/ajax-albums-list'). '?sort='.Yii::$app->request->get('sort'),
			'albums' => $public_albums['albums'],
			'countAlbums' => $public_albums['count'],
			'category' => $category,
		]);
	}

	public function actionAjaxPhotoList($offset)
	{
		$public_photos = Media::getPublicPhotos($offset);

		Yii::$app->response->format = Response::FORMAT_JSON;

		$response['html'] = $this->renderPartial('_one-photo', [
			'photos' => $public_photos['photos'],
		]);
		$response['count'] = count($public_photos['photos']);

		return $response;
	}

	public function actionAjaxAlbumsList($offset)
	{
		$public_albums = CustomGallery::getPublicAlbums($offset);

		$category = new Category();
		$category = $category->getAllCurrentLanguage(Yii::$app->language, 'gallery');

		Yii::$app->response->format = Response::FORMAT_JSON;

		$response['html'] = $this->renderPartial('_one-albums', [
			'albums' => $public_albums['albums'],
			'category' => $category,
		]);

		$response['count'] = count($public_albums['albums']);

		return $response;
	}


}
