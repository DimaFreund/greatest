<?php
/**
 * Created by PhpStorm.
 * User: work
 * Date: 08.02.18
 * Time: 17:22
 */

namespace humhub\modules\user\controllers;


use humhub\components\Controller;
use humhub\modules\admin\models\AdminDesires;
use humhub\modules\admin\models\forms\PagesInfoForm;
use humhub\modules\admin\models\GuestQuestion;
use humhub\modules\space\models\Space;
use Yii;


class TestController  extends Controller{

	public $layout = "@humhub/modules/user/views/layouts/main";
	public $form;

	public function init()
	{
		$this->form = new PagesInfoForm();
		YII::$app->params['class_body'] = 'publicHeader';
		return parent::init();
	}

	public function actionIndex()
	{

		$test =  Yii::$app->mailer->compose([[
			'html' => '@humhub/modules/user/views/mails/UserInviteSelf',
			'text' => '@humhub/modules/user/views/mails/plaintext/UserInviteSelf'
		],
			'token' => 'test']);
		$test2 = Yii::$app->mailer->render('@humhub/modules/notification/views/mails/default', ['html' => 'its simple html', 'url' => 'test', 'space' => Space::findOne(1), 'token' => 'test', 'originator' => Yii::$app->user->getIdentity(), 'registrationUrl' => 'test'], 'layouts/html');

		return $this->renderPartial('index',[ 'result' => $test2]);
	}


}