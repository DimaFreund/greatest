<?php
/**
 * Created by PhpStorm.
 * User: work
 * Date: 12.03.18
 * Time: 13:13
 */

use humhub\libs\Html;
use yii\widgets\ActiveForm;

?>
<div class="page-content">
    <div class="content-wrap">
        <div class="create-blog">
            <h2><?= Yii::t('base','Create'); ?> <?= $isSuccessStories?Yii::t('base','Success stories'):Yii::t('base','blog post'); ?></h2>

			<?php $form = ActiveForm::begin([
				'fieldConfig' => [
					'options' => [
						'class' => 'form-item',
					],
				],
            ]); ?>

			<?= $form->field( $model, 'title' )->textInput( [ 'class' => false ] )->label(Yii::t('base','Title')) ?>


			<?= $form->field( $model, 'message' )->textarea( [ 'rows' => 6, 'class' => false ] )->label(Yii::t('base','Description')) ?>

			<?= $form->field( $model, 'category', [
			        'options' => [
			                'class' => 'sm-item form-item '.($isSuccessStories?'hidden':''),
                    ]
            ] )->dropDownList( $category , ['class' => false])->label(Yii::t('base','Category')); ?>
			<?=
			humhub\modules\file\widgets\UploadButton::widget( [
				'id'       => 'comment_create_upload_' . $model->id,
				'progress' => '#comment_create_upload_progress_' . $model->id,
				'preview'  => '#comment_create_upload_preview_' . $model->id,
				'dropZone' => '#comment_create_form_' . $model->id,
				'max'      => Yii::$app->getModule( 'content' )->maxAttachedFiles
			] );
			?>
            <div id="comment_create_upload_progress_<?= $model->id ?>" style="display:none;margin:10px 0px;"></div>

			<?=
			\humhub\modules\file\widgets\FilePreview::widget( [
				'id'      => 'comment_create_upload_preview_' . $model->id,
				'options' => [ 'style' => 'margin-top:10px' ],
				'edit'    => true,
                'model'   => $model,
			] );
			?>

            <div class="form-group">
                <div class="base-btn reverse">
				<?= Html::submitButton( $model->isNewRecord ? Yii::t('base','Create') : Yii::t('base','Update'), [ 'class' => 'btn btn-primary' ] ) ?>
            </div>
            </div>

			<?php ActiveForm::end(); ?>
        </div>
    </div>
</div>