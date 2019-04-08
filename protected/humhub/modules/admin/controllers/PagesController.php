<?php
/**
 * Created by PhpStorm.
 * User: work
 * Date: 01.02.18
 * Time: 13:56
 */

namespace humhub\modules\admin\controllers;
use humhub\models\MultiUploadImage;
use humhub\models\UploadOneImage;
use humhub\modules\admin\components\Controller;
use humhub\modules\admin\models\forms\PagesInfoForm;
use Yii;
use yii\web\UploadedFile;
//todo redo and add multi language version
class PagesController extends Controller
{
	public $form;
	public function init()
	{
		$this->subLayout = '@admin/views/layouts/pages';
		$this->form = new PagesInfoForm();
		return parent::init();
	}

	public function actionIndex()
	{
		return $this->redirect(['welcome']);
	}



	public function actionAnetwork()
	{

		if ($this->form->load(Yii::$app->request->post()) && $this->form->validate()) {
			$this->form->save();
			$this->view->saved();
		}

		return $this->render('anetwork', [ 'model' => $this->form]);
	}


	public function actionConditions()
	{
		if ($this->form->load(Yii::$app->request->post()) && $this->form->validate()) {
			$this->form->save();
			$this->view->saved();
		}
		return $this->render('conditions', [ 'model' => $this->form]);
	}

	public function actionPolicy()
	{
		if ($this->form->load(Yii::$app->request->post()) && $this->form->validate()) {
			$this->form->save();
			$this->view->saved();
		}
		return $this->render('policy', [ 'model' => $this->form]);
	}

	public function actionFaq()
	{
		if ($this->form->load(Yii::$app->request->post()) && $this->form->validate()) {
			$this->form->save();
			$this->view->saved();
		}
		return $this->render('faq', [ 'model' => $this->form]);
	}

	public function actionWelcome()
	{
		$form = new \humhub\modules\admin\models\forms\WelcomeSettingsForm();

		$image = new UploadOneImage();
		$images = new MultiUploadImage();

		if ($form->load(Yii::$app->request->post()) && $form->validate()) {

			$image->upload($form, 'imageTestimonials1');
			$image->upload($form, 'imageTestimonials2');
			$image->upload($form, 'imageTestimonials3');
			$image->upload($form, 'imageHowWork');
			$image->upload($form, 'successStoriesBackground');
			$image->upload($form, 'slides');

			$images->slides = UploadedFile::getInstances($form, 'slides');
			$form->slides = serialize($images->upload());
			$form->save();
			$this->view->saved();
		}


		return $this->render('welcome', [
			'model' => $form,
			'pathImage' => $image->getPath(),
		]);
	}

}