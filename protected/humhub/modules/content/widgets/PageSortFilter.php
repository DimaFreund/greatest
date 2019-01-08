<?php

namespace humhub\modules\content\widgets;

use humhub\modules\blog\models\Blog;
use Yii;

class PageSortFilter extends \yii\base\Widget
{

	public $models;

	public function run()
	{

		$models = $this->models;

		if(isset($models) && isset($models[0]) && count($models) > 1) {

			$filter = Yii::$app->request->get('Category');

			$filterUrlParamters = http_build_query(['Category' => $filter]);

			$baseUrl = Yii::$app->request->getHostInfo() . Yii::$app->request->getScriptUrl() . '/' . Yii::$app->request->getPathInfo() . '?' . $filterUrlParamters;

			$currentSort = Yii::$app->request->get( 'sort' );

			return $this->render( 'pageSortFilter', [
				'baseUrl'        => $baseUrl,
				'currentSort'    => $currentSort,
				'sortParameters' => $models[0]::getSortParameters(),
			] );
		}
	}

}

?>