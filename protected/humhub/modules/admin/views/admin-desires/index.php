<?php

use humhub\modules\admin\models\AdminDesires;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\AdminDesiresSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Success stories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-desires-index" style="text-align:center">

	<h1><?= Html::encode($this->title) ?></h1>
	<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

	<p>
		<?= Html::a('Create Success stories', ['create'], ['class' => 'btn btn-success']) ?>
	</p>
	<?php Pjax::begin(); ?>    <?= GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'columns' => [
			'id',
			'title',
			[
				'attribute' => 'description',
				'format' => 'html'
			],
			'date',
			[
				'attribute' => 'image',
				'format' => 'html',
				'value' => function ($data) {
					return Html::img('/uploads/admin_files/'.$data->attributes['image'], ['width'=>'200']);
				},

			],
			[
				'class' => 'yii\grid\DataColumn', // может быть опущено, поскольку является значением по умолчанию
				'attribute' => 'status',
				'value' => function ($data) {
					return AdminDesires::getStatusCaption($data->attributes['status']); // $data['name'] для массивов, например, при использовании SqlDataProvider.
				},
				'filter' => ['0' => 'No publish', '1' => 'Publish'],
				'filterInputOptions' => ['prompt' => 'All status', 'class' => 'form-control', 'id' => null],
			],
			['class' => 'yii\grid\ActionColumn'],
		],
	]); ?>
	<?php Pjax::end(); ?></div>
