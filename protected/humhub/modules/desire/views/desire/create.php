<?php
/**
 * Created by PhpStorm.
 * User: work
 * Date: 12.03.18
 * Time: 13:13
 */

use humhub\libs\Html;
use wbraganca\tagsinput\TagsinputWidget;
use yii\widgets\ActiveForm;

?>


<div class="page-content">
    <div class="content-wrap">
        <div class="create-blog create-desire">
            <h2>Write your <?php if($model->greatest) echo 'Greatest'; ?> Desire</h2>
			<?php $form = ActiveForm::begin(); ?>

			<?= $form->field( $model, 'title', [ 'options' => [ 'class' => 'form-group form-item' ] ] )->textInput( [ 'maxlength' => true ] ) ?>
			<?= $form->field( $model, 'Tags', [ 'options' => [ 'class' => 'form-group form-item-tags' ] ] )->widget( TagsinputWidget::classname(), [
				'clientOptions' => [
					'trimValue'       => true,
					'allowDuplicates' => false
				],
				'options'       => [
					'multiple',
				]

			] );
			?>
            <script>
                $('#desire-tags').on('beforeItemAdd', function(event) {
                    if (event.item.length < 3) {
                        event.cancel = true;
                    }
                });
            </script>


			<?= $form->field( $model, 'message', [ 'options' => [ 'class' => 'form-group form-item' ] ] )->textarea( [ 'rows' => 6 ] ) ?>
            <div class="create-desire-wrap">
				<?= $form->field( $model, 'greatest' )->checkbox(); ?>
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

            </div>
            <div class="form-group base-btn reverse">
		        <?= Html::submitButton( $model->isNewRecord ? 'Create' : 'Update', [ 'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary' ] ) ?>
            </div>
			<?php ActiveForm::end(); ?>
        </div>
    </div>
</div>