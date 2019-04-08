<?php

use yii\widgets\ActiveForm;
use humhub\compat\CHtml;
?>
<div class="panel-body">
	<h4><?= Yii::t('AdminModule.setting', 'Settings start page'); ?></h4>
	<div class="help-block">
		<?= Yii::t('AdminModule.setting', 'Here you can configure public start page of your social network.'); ?>
	</div>

	<br>

	<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>


	<div class="row">
		<div class="col-md-12">
			<?= $form->field($model, 'faq')->textarea(['rows' => 6]); ?>

		</div>
	</div>

	<?= CHtml::submitButton(Yii::t('AdminModule.views_setting_index', 'Save'), ['class' => 'btn btn-primary', 'data-ui-loader' => ""]); ?>

	<!-- show flash message after saving -->
	<?php \humhub\widgets\DataSaved::widget(); ?>

	<?php ActiveForm::end(); ?>
</div>
