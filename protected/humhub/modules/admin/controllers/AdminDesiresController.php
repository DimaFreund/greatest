<?php

namespace humhub\modules\admin\controllers;

use humhub\models\UploadOneImage;
use humhub\modules\admin\models\forms\PagesInfoForm;
use Yii;
use humhub\modules\admin\models\AdminDesires;
use humhub\modules\admin\models\AdminDesiresSearch;
use humhub\modules\admin\components\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AdminDesiresController implements the CRUD actions for AdminDesires model.
 */
class AdminDesiresController extends Controller
{
	/**
	 * @inheritdoc
	 */

	public function init()
	{
		$this->subLayout = '@admin/views/layouts/desires';
		return parent::init();
	}

	public function behaviors()
	{
		return [
			'verbs' => [
				'class' => VerbFilter::className(),
				'actions' => [
					'delete' => ['POST'],
				],
			],
		];
	}

	/**
	 * Lists all AdminDesires models.
	 * @return mixed
	 */
	public function actionIndex()
	{
		$searchModel = new AdminDesiresSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

		return $this->render('index', [
			'searchModel' => $searchModel,
			'dataProvider' => $dataProvider,
		]);
	}

	/**
	 * Displays a single AdminDesires model.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionView($id)
	{
		return $this->render('view', [
			'model' => $this->findModel($id),
		]);
	}

	/**
	 * Creates a new AdminDesires model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate()
	{
		$model = new AdminDesires();
		$image = new UploadOneImage();
		if ($model->load(Yii::$app->request->post())) {
			$image->upload($model, 'image');
			$model->save();
			return $this->redirect(['view', 'id' => $model->id]);
		} else {
			return $this->render('create', [
				'model' => $model,
				'pathImage' => $image->getPath(),
			]);
		}
	}

	/**
	 * Updates an existing AdminDesires model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionUpdate($id)
	{
		$model = $this->findModel($id);
		$image = new UploadOneImage();

		if ($model->load(Yii::$app->request->post())) {
			$image->upload($model, 'image');
			$model->save();

			return $this->redirect(['view', 'id' => $model->id]);
		} else {
			return $this->render('update', [
				'model' => $model,
				'pathImage' => $image->getPath(),
			]);
		}
	}

	/**
	 * Deletes an existing AdminDesires model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionDelete($id)
	{
		$this->findModel($id)->delete();

		return $this->redirect(['index']);
	}

	/**
	 * Finds the AdminDesires model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return AdminDesires the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id)
	{
		if (($model = AdminDesires::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}
}
