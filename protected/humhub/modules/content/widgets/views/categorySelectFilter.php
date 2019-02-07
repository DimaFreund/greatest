<?php

use humhub\widgets\ActiveForm;
use yii\bootstrap\Html;
use yii\helpers\Url;

?>



<div class="page-filter category-filter show-on-tablet">
	<?= \yii\helpers\Html::dropDownList('sort', Yii::$app->request->get('Category')['filter'], $category, [
	        'onchange' => "location = '".Yii::$app->request->getHostInfo() . Yii::$app->request->getScriptUrl() . '/' . Yii::$app->request->getPathInfo()."?Category[filter][]=' + this.value;"
    ]); ?>

</div>


