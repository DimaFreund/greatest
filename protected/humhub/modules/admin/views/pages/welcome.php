<?php

use humhub\libs\TimezoneHelper;
use kartik\file\FileInput;
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
	<?=
    $form->field($model, 'slides[]')->widget(FileInput::classname(), [
		'options' => ['multiple' => true, 'accept' => 'image/*'],
		'pluginOptions' => ['previewFileType' => 'image', 'initialPreviewAsData'=>true, 'overwriteInitial'=>false,'initialPreview'=> unserialize($model->slides),]
	]);

     ?>
    <div class="row">
        <div class="col-md-4 col-sm-4"><?= $form->field($model, 'totalRegisters'); ?></div>
        <div class="col-md-4 col-sm-4"><?= $form->field($model, 'conceivedDesires'); ?></div>
        <div class="col-md-4 col-sm-4"><?= $form->field($model, 'successStories'); ?></div>
    </div>

    <div class="row">
        <div class="col-md-4 col-sm-4">
            <?= $form->field($model, 'imageTestimonials1')->widget(FileInput::classname(), [
	            'name' => 'attachment_53',
	            'pluginOptions' => [
		            'showCaption' => false,
		            'showRemove' => false,
		            'showUpload' => false,
		            'browseClass' => 'btn btn-primary btn-block',
		            'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
		            'browseLabel' =>  'Select Photo',
		            'showUpload' => false,
		            'initialPreviewAsData'=>true,
		            'allowedFileExtensions' => ['jpg','png','jpeg'],
		            'initialPreview'=> [
			            '/'.$pathImage.$model->imageTestimonials1,
		            ],
	            ],
            ]); ?>
            <?= $form->field($model, 'firstTestimonials'); ?>
            <?= $form->field($model, 'firstTestimonialsText')->textarea(['rows' => 6]); ?></div>
        <div class="col-md-4 col-sm-4">
	        <?= $form->field($model, 'imageTestimonials2')->widget(FileInput::classname(), [
		        'name' => 'attachment_53',
		        'pluginOptions' => [
			        'showCaption' => false,
			        'showRemove' => false,
			        'showUpload' => false,
			        'browseClass' => 'btn btn-primary btn-block',
			        'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
			        'browseLabel' =>  'Select Photo',
			        'showUpload' => false,
			        'initialPreviewAsData'=>true,
			        'allowedFileExtensions' => ['jpg','png','jpeg'],
			        'initialPreview'=> [
				        '/'.$pathImage.$model->imageTestimonials2,
			        ],
		        ],
	        ]); ?>
            <?= $form->field($model, 'twoTestimonials'); ?>
            <?= $form->field($model, 'twoTestimonialsText')->textarea(['rows' => 6]); ?></div>
        <div class="col-md-4 col-sm-4">
	        <?= $form->field($model, 'imageTestimonials3')->widget(FileInput::classname(), [
		        'name' => 'attachment_53',
		        'pluginOptions' => [
			        'showCaption' => false,
			        'showRemove' => false,
			        'showUpload' => false,
			        'browseClass' => 'btn btn-primary btn-block',
			        'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
			        'browseLabel' =>  'Select Photo',
			        'showUpload' => false,
			        'initialPreviewAsData'=>true,
			        'allowedFileExtensions' => ['jpg','png','jpeg'],
			        'initialPreview'=> [
				        '/'.$pathImage.$model->imageTestimonials3,
			        ],
		        ],
	        ]); ?>
            <?= $form->field($model, 'threeTestimonials'); ?>
            <?= $form->field($model, 'threeTestimonialsText')->textarea(['rows' => 6]); ?></div>
    </div>

    <div class="row">
        <div class="col-md-6">
	        <?= $form->field($model, 'imageHowWork')->widget(FileInput::classname(), [
		        'name' => 'attachment_53',
		        'pluginOptions' => [
			        'showCaption' => false,
			        'showRemove' => false,
			        'showUpload' => false,
			        'browseClass' => 'btn btn-primary btn-block',
			        'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
			        'browseLabel' =>  'Select Photo',
			        'showUpload' => false,
			        'initialPreviewAsData'=>true,
			        'allowedFileExtensions' => ['jpg','png','jpeg'],
			        'initialPreview'=> [
				        '/'.$pathImage.$model->imageHowWork,
			        ],
		        ],
	        ]); ?>
        </div>
        <div class="col-md-6">
	        <?= $form->field($model, 'successStoriesBackground')->widget(FileInput::classname(), [
		        'name' => 'attachment_53',
		        'pluginOptions' => [
			        'showCaption' => false,
			        'showRemove' => false,
			        'showUpload' => false,
			        'browseClass' => 'btn btn-primary btn-block',
			        'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
			        'browseLabel' =>  'Select Photo',
			        'showUpload' => false,
			        'initialPreviewAsData'=>true,
			        'allowedFileExtensions' => ['jpg','png','jpeg'],
			        'initialPreview'=> [
				        '/'.$pathImage.$model->successStoriesBackground,
			        ],
		        ],
	        ]); ?>
        </div>
    </div>


    <?= CHtml::submitButton(Yii::t('AdminModule.views_setting_index', 'Save'), ['class' => 'btn btn-primary', 'data-ui-loader' => ""]); ?>

    <!-- show flash message after saving -->
    <?php \humhub\widgets\DataSaved::widget(); ?>

    <?php ActiveForm::end(); ?>
</div>
