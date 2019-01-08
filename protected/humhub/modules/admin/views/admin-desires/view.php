<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\AdminDesires */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Success stories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-desires-view">

	<h1><?= Html::encode($this->title) ?></h1>

	<p>
		<?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
		<?= Html::a('Delete', ['delete', 'id' => $model->id], [
			'class' => 'btn btn-danger',
			'data' => [
				'confirm' => 'Are you sure you want to delete this item?',
				'method' => 'post',
			],
		]) ?>
	</p>

	<?= DetailView::widget([
		'model' => $model,
		'attributes' => [
			'id',
			'title',
			[
				'attribute' => 'description',
				'format' => 'html'
			],
			[
				'attribute' => 'content',
				'format' => 'html'
			],
			'date',
			[
				'attribute' => 'image',
				'format' => 'html',
				'value' => function ($data) {
					return Html::img('/uploads/admin_files/'.$data->attributes['image'], ['width'=>200]);
				},

			],
			'status',
		],
	]) ?>
    <style>
        table td img {
            max-width: 100%;
        }
    </style>
</div>
