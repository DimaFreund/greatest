<?php

namespace humhub\modules\polls\controllers;

use humhub\components\GeneralController;
use Yii;
use humhub\modules\polls\models\Poll;

/**
 * PollController handles all poll related actions.
 *
 * @package humhub.modules.polls.controllers
 * @since 0.5
 * @author Luke
 */
class ListController extends GeneralController
{

	public function actions() {
		return array(
			'streamPublic' => array(
				'class' => \humhub\modules\polls\components\StreamPublicAction::className(),
				'includes' => Poll::className(),
				'mode' => \humhub\modules\polls\components\StreamPublicAction::MODE_NORMAL,
			),
		);
	}

	public function actionIndex()
	{
		$model = Poll::find();

		return $this->render('index', [
			'count' => $model->count(),
		]);
	}



}
