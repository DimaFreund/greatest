<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2015 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\blog\controllers;

use humhub\components\GeneralController;
use humhub\components\Response;
use humhub\modules\blog\models\Blog;
use humhub\modules\content\models\Category;
use Yii;
use yii\helpers\Url;

/**
 * @package humhub.modules_core.blog.controllers
 * @since 0.5
 */
class BlogController extends GeneralController {

	public $submitUrl = 'blog/create';

	public function behaviors()
	{
		return [
			'acl' => [
				'class' => \humhub\components\behaviors\AccessControl::className(),
				'guestAllowedActions' => ['index', 'stream', 'about']
			]
		];
	}

	public function actionIndex() {

		$data = Blog::getAllPublic();

		$category = new Category();
		$category = $category->getAllCurrentLanguage(Yii::$app->language, 'blog');

		$filter = Yii::$app->request->get('Category')['filter'];
		$isSuccessStories = ($filter && $filter[0] && count($filter) === 1 && $filter[0] == '100')?true:false;

		$title = $isSuccessStories?'Success stories':'Blog';

		return $this->render('list', [
			'articles' => $data['blog'],
			'count' => $data['count'],
			'category' => $category,
			'title' => $title,
			'ajaxUrl' => '/blog/blog/ajax-list?sort='.Yii::$app->request->get('sort'),
		]);

	}

	public function actionAjaxList($offset) {
		$data = Blog::getAllPublic($offset);

		$category = new Category();
		$category = $category->getAllCurrentLanguage(Yii::$app->language, 'blog');

		Yii::$app->response->format = Response::FORMAT_JSON;

		$result['html'] = $this->renderPartial('_list', [
			'articles' => $data['blog'],
			'category' => $category,
		]);
		$result['count'] = $data['count'];

		return $result;

	}

	public function actionCreate() {

		$model = new Blog();

		$category = new Category();
		$category = $category->getAllCurrentLanguage(Yii::$app->language, 'blog');

		$model->content->visibility = 1;
		$model->content->container = $this->contentContainer;

		if ( $model->load( Yii::$app->request->post() ) && $model->validate() && $model->save() ) {

			$this->view->saved();
			$model->saveFiles();
			$model->saveTags();

			return $this->redirect( $model->user->createUrl('/user/profile/blog-one', ['id' => $model->id ]) );
		}

		$isSuccessStories = (Yii::$app->request->get('id') == 100);

		if($isSuccessStories) {
			$model->category = 100;
		}

		return $this->render( 'create',
			[
				'model' => $model,
				'category'  => $category,
				'isSuccessStories' => $isSuccessStories,
			]
		);
	}


	public function actionUpdate( $id ) {

		$model = $this->findModel( $id );

		if ( ! $model->content->canEdit() ) {
			$this->forbidden();
		}

		$category = new Category();
		$category = $category->getAllCurrentLanguage(Yii::$app->language, 'blog');

		$isSuccessStories = ($model->category == 100);


//		$this->setContentSettings($model);

		if ( $model->load( Yii::$app->request->post() ) && $model->validate() && $model->save() ) {

			$this->view->saved();
			$model->saveFiles();
			$model->saveTags();

			return $this->redirect( $model->user->createUrl('/user/profile/blog-one', ['id' => $model->id ]) );
		}

		return $this->render( 'create',
			[
				'model' => $model,
				'submitUrl' => Url::toRoute('/blog/blog/update'),
				'category' => $category,
				'isSuccessStories' => $isSuccessStories,
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

		return $this->redirect($model->user->createUrl('/user/profile/blog'));
	}

	protected function findModel($id)
	{
		if (($model = Blog::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}





}
