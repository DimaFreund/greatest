<?php
/**
 * Created by PhpStorm.
 * User: work
 * Date: 16.02.18
 * Time: 18:02
 */

namespace humhub\modules\admin\controllers;


use humhub\modules\admin\components\Controller;
use humhub\modules\content\models\Category;
use humhub\modules\news\models\News;
use Yii;
use yii\helpers\Url;

class NewsController extends Controller {

	public function init() {
		$this->subLayout = '@admin/views/layouts/guest-question';

		return parent::init();
	}

	public function actionCreate() {

		$model = new News();

		$category = new Category();
		$category = $category->getAllCurrentLanguage( Yii::$app->language, 'news' );

		$model->content->visibility = 1;
		$model->content->container  = Yii::$app->user->getIdentity();

		if ( $model->load( Yii::$app->request->post() ) && $model->validate() && $model->save() ) {

			$this->view->saved();
			$model->saveFiles();
			$model->saveTags();

			return $this->redirect( [ 'view', 'id' => $model->id ] );
		}

		return $this->render( 'create',
			[
				'model'    => $model,
				'category' => $category,
			]
		);

	}

	public function actionUpdate( $id ) {

		$model = $this->findModel( $id );

		if ( ! $model->content->canEdit() ) {
			$this->forbidden();
		}
		$category = new Category();
		$category = $category->getAllCurrentLanguage( Yii::$app->language, 'news' );

//		$this->setContentSettings($model);

		if ( $model->load( Yii::$app->request->post() ) && $model->validate() && $model->save() ) {

			$this->view->saved();
			$model->saveFiles();
			$model->saveTags();

			return $this->redirect( [ 'view', 'id' => $model->id ] );
		}

		return $this->render( 'create',
			[
				'model' => $model,
				'submitUrl' => Url::toRoute('/admin/news/update'),
				'category' => $category,
			]
		);
	}

	public function actionDelete($id)
	{

		$model = $this->findModel( $id );

		if ( ! $model->content->canEdit() ) {
			$this->forbidden();
		}
		$model->delete();

		return $this->redirect(['list']);
	}

	protected function findModel($id)
	{
		if (($model = News::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}

}