<?php
/**
 * Created by PhpStorm.
 * User: work
 * Date: 12.03.18
 * Time: 13:13
 */

use humhub\libs\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

?>
<h2>Write your Greatest News</h2>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>


<?= $form->field($model, 'message')->textarea(['rows' => 6]) ?>
<div class="comment-buttons">

	<?=
	\humhub\modules\file\widgets\UploadButton::widget([
		'id' => 'comment_upload_' . $model->id,
		'model' => $model,
		'dropZone' => '#comment_'.$model->id,
		'preview' => '#comment_upload_preview_'.$model->id,
		'progress' => '#comment_upload_progress_'.$model->id,
		'max' => Yii::$app->getModule('content')->maxAttachedFiles
	]);
	?>




</div>
<div id="comment_upload_progress_<?= $model->id ?>" style="display:none; margin:10px 0;"></div>

<?=
\humhub\modules\file\widgets\FilePreview::widget([
	'id' => 'comment_upload_preview_'.$model->id,
	'options' => ['style' => 'margin-top:10px'],
	'model' => $model,
	'edit' => true
]);
?>
<div class="form-group">
	<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>
