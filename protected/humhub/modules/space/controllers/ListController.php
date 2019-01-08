<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2016 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\space\controllers;

use humhub\components\GeneralController;
use humhub\components\Response;
use humhub\modules\content\models\Category;
use humhub\modules\space\models\Space;
use Yii;

class ListController extends GeneralController {

	public function actionIndex() {

		$data = Space::getAllPublic();


		return $this->render('index', [
			'spaces' => $data['spaces'],
			'count' => $data['count'],
			'category' => $this->getCategory(),
			'ajaxUrl' => '/space/list/ajax-list?sort='.Yii::$app->request->get('sort'),
		]);
	}

	public function actionAjaxList($offset)
	{
		$data = Space::getAllPublic($offset);

		Yii::$app->response->format = Response::FORMAT_JSON;

		$result['html'] = $this->renderPartial('_list',[
			'spaces' => $data['spaces'],
			'category' => $this->getCategory()
		]);

		$result['count'] = $data['count'];

		return $result;
	}

	private function getCategory() {

		$category = new Category();
		$category = $category->getAllCurrentLanguage(Yii::$app->language, 'space');

		return $category;
	}


}