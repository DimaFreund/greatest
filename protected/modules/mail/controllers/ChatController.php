<?php

namespace humhub\modules\mail\controllers;

use humhub\components\GeneralController;
use humhub\modules\mail\models\Chat;
use yii\httpclient\Client;

/**
 * MailController provides messaging actions.
 *
 * @package humhub.modules.mail.controllers
 * @since 0.5
 */
class ChatController extends GeneralController {

	public function actionIndex()
	{
		$chat = new Chat();

		$token = $chat->authentication();
		return $this->render('chat', [
			'loginToken' => $token,
		]);
	}


}