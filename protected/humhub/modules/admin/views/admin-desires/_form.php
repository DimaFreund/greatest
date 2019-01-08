<?php

use kartik\date\DatePicker;
use kartik\file\FileInput;
use yii\bootstrap\Dropdown;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AdminDesires */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="admin-desires-form">

	<?php $form = ActiveForm::begin(); ?>

	<?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

	<?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

	<?php
	echo $form->field($model, 'date')->widget(DatePicker::classname(), [
		'options' => ['placeholder' => 'Enter birth date ...'],
		'pluginOptions' => [
			'autoclose'=>true,
			'format' => 'yyyy-mm-dd'
		]
	]);
    ?>

	<?= $form->field($model, 'image')->widget(FileInput::classname(), [
		'name' => 'image',
		'pluginOptions' => [
			'showCaption' => false,
			'showRemove' => false,
			'showUpload' => false,
			'browseClass' => 'btn btn-primary btn-block',
			'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
			'browseLabel' =>  'Select Image',
			'showUpload' => false,
			'initialPreviewAsData'=>true,
			'allowedFileExtensions' => ['jpg','png','jpeg'],
			'initialPreview'=> [
				'/'.$pathImage.$model->image,
			],
		],
	]); ?>
	<?php
	echo $form->field($model, 'status')
	          ->dropDownList(
		          ['0'=>'no publish','1'=>'publish']           // Flat array ('id'=>'label')
	          );
    ?>

	<div class="form-group">
		<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	</div>

	<?php ActiveForm::end(); ?>

</div>
