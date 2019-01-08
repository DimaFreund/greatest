<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AdminDesires */

$this->title = 'Create Success stories';
$this->params['breadcrumbs'][] = ['label' => 'Admin Desires', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-desires-create">

    <h1><?= Html::encode($this->title) ?></h1>

	<?= $this->render('_form', [
		'model' => $model,
		'pathImage' => $pathImage,
	]) ?>

</div>
