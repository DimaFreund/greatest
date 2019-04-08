<?php

use humhub\modules\file\widgets\ShowFiles;
use yii\helpers\Html;
use yii\widgets\DetailView;
?>
<?= DetailView::widget([
	'model' => $model,
	'attributes' => [
		'id',
		'title',
		[
			'attribute' => 'message',
			'format' => 'html'
		],
	],
]) ?>
<?= ShowFiles::widget(['object' => $model]); ?>
<?= Html::a('Edit', ['blog/update', 'id'=>$model->id]); ?>
