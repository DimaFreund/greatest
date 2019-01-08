<?php

namespace humhub\modules\rating\controllers;


use humhub\components\Controller;
use humhub\modules\rating\models\Rating;
use Yii;

class RatingController extends Controller {

	/**
	 * @inheritdoc
	 */
	public function behaviors() {
		return [
			'acl' => [
				'class'               => \humhub\components\behaviors\AccessControl::className(),
				'guestAllowedActions' => [ 'show-likes' ]
			]
		];
	}

	public function actionAdd()
	{
		Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

		$request = Yii::$app->request->post();

		$objectId = $request['objectId'];

		$voices = Rating::getCurrentUserVoice($objectId);

		if(!$voices) {
			$voices = new Rating();
			$voices->desire_id = $objectId;
		}
			$voices->rating = $request['rating'];
			if($voices->validate() &&  $voices->save()) {
				return 'ok';
			}

		return 'error';
	}
}