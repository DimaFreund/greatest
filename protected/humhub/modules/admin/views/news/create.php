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
    <div class="content-wrap">
        <div class="create-blog">
            <h2>Create news</h2>

			<?php $form = ActiveForm::begin([
				'fieldConfig' => [
					'options' => [
						'class' => 'form-item',
					],
				],
			]); ?>

			<?= $form->field( $model, 'title' )->textInput( [ 'maxlength' => true, 'class' => false ] ) ?>


			<?= $form->field( $model, 'message' )->textarea( [ 'rows' => 6, 'class' => false ] ) ?>

			<?= $form->field( $model, 'category', [
				'options' => [
					'class' => 'sm-item form-item',
				]
			] )->dropDownList( $category , ['class' => false]); ?>
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
				'edit'    => true
			] );
			?>

            <div class="form-group">
                <div class="base-btn reverse">
					<?= Html::submitButton( $model->isNewRecord ? 'Create' : 'Update', [ 'class' => $model->isNewRecord ? '' : 'btn btn-primary' ] ) ?>
                </div>
            </div>

			<?php ActiveForm::end(); ?>
        </div>
    </div>