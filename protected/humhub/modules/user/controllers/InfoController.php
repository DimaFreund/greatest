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
use Yii;


class InfoController  extends Controller{

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
		$stories = AdminDesires::find()->limit(9)->orderBy('date DESC')->all();
		return $this->render('index', ['model' => $stories]);
	}

	public function actionView($id)
	{
		$article = AdminDesires::findOne($id);

		return $this->render('article', ['model' => $article]);
	}

	public function actionPolicy()
	{
		return $this->render('info', ['form' => $this->form->policy, 'class' => 'privacy-policy']);
	}

	public function actionAnetwork()
	{
		return $this->render('info', ['form' => $this->form->anetwork, 'class' => 'privacy-policy']);
	}

	public function actionConditions()
	{
		return $this->render('info', ['form' => $this->form->conditions, 'class' => 'privacy-policy']);
	}

	public function actionFaq()
	{
		return $this->render('info', ['form' => $this->form->faq, 'class' => 'faq']);
	}

	public function actionContact()
	{
		$model = new GuestQuestion();

		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			return $this->render('successful_question');
		}

		return $this->render('contact',['model' => $model]);
	}
}