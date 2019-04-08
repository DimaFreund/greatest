<?php
/**
 * Created by PhpStorm.
 * User: work
 * Date: 01.02.18
 * Time: 13:56
 */

namespace humhub\modules\admin\controllers;

use humhub\modules\admin\components\Controller;
use humhub\modules\content\models\Category;
use Yii;
use yii\helpers\ArrayHelper;

const DEFAULT_LANGUAGE = 'en';

class CategoryController extends Controller
{
	public $form;

	public function init()
	{
		$this->subLayout = '@admin/views/layouts/category';
		$this->form = new Category();
		return parent::init();
	}

	public function actionIndex()
	{
		return $this->redirect(['blog?lan=en']);
	}



	public function actionBlog($lan)
	{
		return $this->getCategoryEdit($lan, Yii::$app->controller->action->id);
	}

	public function actionSpace($lan)
	{
		return $this->getCategoryEdit($lan, Yii::$app->controller->action->id);
	}

	public function actionGallery($lan)
	{
		return $this->getCategoryEdit($lan, Yii::$app->controller->action->id);
	}

	public function actionPoll($lan)
	{
		return $this->getCategoryEdit($lan, Yii::$app->controller->action->id);
	}

	public function actionNews($lan)
	{
		return $this->getCategoryEdit($lan, Yii::$app->controller->action->id);
	}

	public function actionDelete($id)
	{
		$test = $this->form->findOne($id);
		$test->delete();
		return $this->redirect(['blog', 'lan' => 'en']);
	}

	protected function getCategoryEdit($lan, $object_model)
	{
		$category = $this->form->find()->where(['object_model' => $object_model])->orderBy(['name' => SORT_ASC])->all();

		$request = Yii::$app->request->post();

		if ($request) {

			if($lan != DEFAULT_LANGUAGE){
				$category = ArrayHelper::index($category, 'id');
				foreach($request['Translate'] as $key => $value){
					if($value != '') {
						$old_name               = $category[ $key ]->name;
						$old_name               = unserialize( $old_name );
						$old_name[ $lan ]       = $value;
						$category[ $key ]->name = serialize( $old_name );
						$category[ $key ]->save();
					}
				}
			} else {
				$request['Category']['name'] = serialize( [ $lan => $request['Category']['name'] ] );
				$this->form->load( $request );
				$this->form->object_model = $object_model;
				$this->form->save();
				$this->view->saved();
			}
			return $this->redirect([$object_model, 'lan' => $lan]);
		}



		foreach ($category as $key=>$item){

			$name = unserialize($item['name']);

			if(isset($name[DEFAULT_LANGUAGE])) {

				$item['default_language'] = $name[DEFAULT_LANGUAGE];

				if(isset($name[$lan])) {
					$item['name'] = '<input type="text" name="Translate['. $item['id'] .']" value="'.$name[$lan].'">';
				} else {
					$item['name'] = '<input type="text" name="Translate['. $item['id'] .']">';
				}
			} else {
				unset( $category[ $key ] );
			}
		}

		$isDefaultLanguage = DEFAULT_LANGUAGE == $lan;

		return $this->render('index', [ 'model' => $this->form, 'category' => $category, 'isDefaultLanguage' => $isDefaultLanguage]);
	}

}