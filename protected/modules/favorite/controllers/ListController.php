<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2015 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\favorite\controllers;

use humhub\components\GeneralController;
use humhub\modules\blog\models\Blog;
use humhub\modules\desire\models\Desire;
use humhub\modules\favorite\models\Favorite;
use humhub\modules\gallery\models\CustomGallery;
use humhub\modules\gallery\models\Media;
use humhub\modules\polls\models\Poll;
use Yii;

/**
 * @package humhub.modules_core.blog.controllers
 * @since 0.5
 */
class ListController extends GeneralController {


	public function behaviors()
	{
		return [
			'acl' => [
				'class' => \humhub\components\behaviors\AccessControl::className(),
				'guestAllowedActions' => ['index', 'stream', 'about']
			]
		];
	}

	public function actionIndex()
	{

		$contentId = $this->contentContainer->id;

		$counts = Favorite::getCountObjectsByUser($this->contentContainer);

		$photos = Favorite::getFavoriteContentQuery(Media::className(), $contentId)->limit(6)->all();

		$albums = Favorite::getFavoriteContentQuery(CustomGallery::className(), $contentId)->limit(3)->all();

		$blogs = Favorite::getFavoriteContentQuery(Blog::className(), $contentId)->limit(3)->all();

		$desires = Favorite::getFavoriteContentQuery(Desire::className(), $contentId)->limit(3)->all();

		$polls = Favorite::getFavoriteContentQuery(Poll::className(), $contentId)->limit(3)->all();

		return $this->render('index',
			[
				'counts' => $counts,
				'photos' => $photos,
				'albums' => $albums,
				'blogs'  => $blogs,
				'desires' => $desires,
				'polls'  => $polls
			]);
	}






}
