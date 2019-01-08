<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2015 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\favorite\controllers;

use humhub\modules\favorite\models\Favorite;
use Yii;

/**
 * Like Controller
 *
 * Handles requests by the like widgets. (e.g. like, unlike, show likes)
 *
 * @package humhub.modules_core.like.controllers
 * @since 0.5
 */
class FavoriteController extends \humhub\modules\content\components\ContentAddonController
{

	/**
	 * @inheritdoc
	 */
	public function behaviors()
	{
		return [
			'acl' => [
				'class' => \humhub\components\behaviors\AccessControl::className(),
				'guestAllowedActions' => ['show-likes']
			]
		];
	}

	public function init() {

		Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

		parent::init();
	}


	/**
	 * Creates a new like
	 */
	public function actionFavorite()
	{
		$this->forcePostRequest();

		$favorite = Favorite::findOne(['object_model' => $this->contentModel, 'object_id' => $this->contentId, 'created_by' => Yii::$app->user->id]);
		if ($favorite === null) {

			// Create Favorite Object
			$favorite = new Favorite([
				'object_model' => $this->contentModel,
				'object_id' => $this->contentId
			]);
			$favorite->save();
		}

		return ["currentUserFavorited" => true,"favoriteCounter" => 1];
	}

	/**
	 * Unlikes an item
	 */
	public function actionUnfavorite()
	{
		$this->forcePostRequest();

		if (!Yii::$app->user->isGuest) {
			$favorite = Favorite::findOne(['object_model' => $this->contentModel, 'object_id' => $this->contentId, 'created_by' => Yii::$app->user->id]);
			if ($favorite !== null) {
				$favorite->delete();
			}
		}

		return ["currentUserFavorited" => false, "favoriteCounter" => 0];
	}



}
