<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2015 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\desire\controllers;

use const Couchbase\ENCODER_FORMAT_JSON;
use humhub\components\Controller;
use humhub\components\Response;
use humhub\modules\desire\models\Desire;
use humhub\modules\desire\models\forms\SearchForm;
use humhub\modules\tags\models\Tags;
use humhub\modules\user\behaviors\ProfileController;
use humhub\modules\user\models\Profile;
use Yii;
use yii\web\HttpException;

/**
 * @package humhub.modules_core.desire.controllers
 * @since 0.5
 */
class DesireController extends Controller {

	public $submitUrl = 'desire/create';

	public $contentContainer = null;

	public function init() {

		$this->contentContainer = YII::$app->user->getIdentity();
		if ( $this->contentContainer == null ) {
			throw new HttpException( 404, Yii::t( 'base', 'User not found!' ) );
		}

		$this->attachBehavior( 'ProfileControllerBehavior', [
			'class' => ProfileController::className(),
			'user'  => $this->contentContainer,
		] );


		parent::init();
	}


	public function behaviors()
	{
		return [
			'acl' => [
				'class' => \humhub\components\behaviors\AccessControl::className(),
				'guestAllowedActions' => ['index', 'stream', 'about']
			]
		];
	}



	public function actionCreate() {

		$model = new Desire();
		$model->content->visibility = 1;
		$model->content->container = $this->contentContainer;


		if ( $model->load( Yii::$app->request->post() ) && $model->validate() && $model->save() ) {
			$this->view->saved();
			$model->saveFiles();
			$model->saveTags();
			$model->saveGreatestDesire();

			return $this->redirect( [ 'view', 'id' => $model->id ] );
		}

		return $this->render( 'create',
			[
				'model' => $model,
			]
		);
	}

	public function actionView( $id ) {

		$user = Yii::$app->user->getIdentity();
		$this->redirect($user->createUrl('/user/profile/desire-one', ['id' => $id]));
	}

	public function actionUpdate( $id ) {

		$model = $this->findModel( $id );

		if ( ! $model->content->canEdit() ) {
			$this->forbidden();
		}

		$model->content->visibility = 1;
		$model->content->container = $this->contentContainer;




		if ( $model->load( Yii::$app->request->post() ) && $model->validate() && $model->save() ) {

			$this->view->saved();
			$model->saveFiles();
			$model->saveTags();
			$model->saveGreatestDesire();

			return $this->redirect( [ 'view', 'id' => $model->id ] );
		}

		return $this->render( 'create',
			[
				'model' => $model,
			]
		);
	}

	public function actionDelete($id)
	{

		$model = $this->findModel( $id );

		if ( ! $model->content->canEdit() ) {
			$this->forbidden();
		}
		$model->content->delete();
		$user = Yii::$app->user->getIdentity();
		return $this->redirect($user->createUrl('/user/profile/desires'));
	}

	public function actionList()
	{

		//Yii::$app->assetManager->forceCopy = true; // for develepment
		$this->subLayout = "@humhub/views/layouts/_sublayout";
		$data = Desire::getAll(10);
		$articles = $data['articles'];
		$count = $data['count'];



		return $this->render('list', [
			'articles' => $articles,
			'count' => $count,
			'ajaxUrl' => '/desire/desire/list-ajax?sort='.Yii::$app->request->get('sort'),
		]);
	}

	public function actionListAjax($offset)
	{
		Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

		$data = Desire::getAll(10, $offset);
		$articles = $data['articles'];
		$result['html'] = $this->renderAjax('list-ajax', [
			'articles' => $articles,
		]);
		$result['count'] = count($articles);

		return $result;
	}

	public function actionSearch()
	{

		$model = new SearchForm();
		$resultSearch = null;

		if($model->load(Yii::$app->request->get()) && $model->validate()) {

			$resultSearch = $model->searchByTags();
		}

		return $this->render('search',[
			'model' => $model,
			'resultSearch' => $resultSearch,
		]);
	}

	public function actionAutoTips()
	{
		Yii::$app->response->format = Response::FORMAT_JSON;
		$word = Yii::$app->request->post('word');

		$tips = Tags::find();
		$tips->where(['like', 'title', $word.'%', false]);
		$tips->limit(5);
		$result = $tips->all();

		return $result;
	}
	public function actionAutoTipsCountry()
	{
		Yii::$app->response->format = Response::FORMAT_JSON;
		$word = Yii::$app->request->post('word');

		$tips = (new Profile)->getOptionsField('country');

		$result = false;

		foreach ($tips as $key=>$tip) {
			if(stripos($tip, $word) === 0) {
				$result[$key] = $tip;
			}
		}

		return $result;
	}

	protected function findModel($id)
	{
		if (($model = Desire::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}




}
