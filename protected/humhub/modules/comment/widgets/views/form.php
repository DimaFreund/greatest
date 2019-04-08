<?php

use yii\helpers\Html;
use yii\helpers\Url;
?>

<div id="comment_create_form_<?= $id; ?>" class="comment-form" data-ui-widget="comment.Form">
	<?php $userModel = Yii::$app->user->getIdentity(); ?>
    <div class="author-img"><img src="<?= $userModel->getProfileImage()->getUrl(); ?>"></div>
    <div class="textarea-block">
    <?= Html::beginForm('#'); ?>
    <?= Html::hiddenInput('contentModel', $modelName); ?>
    <?= Html::hiddenInput('contentId', $modelId); ?>

    <?=
    humhub\widgets\RichtextField::widget([
        'id' => 'newCommentForm_' . $id,
        'name' => 'message'
    ]);
    ?>
        <script>
            $(document).ready(function() {
                $("#<?= 'newCommentForm_' . $id; ?>").emojioneArea({
                });
            });
        </script>

    <div class="comment-buttons">
        <?=
        humhub\modules\file\widgets\UploadButton::widget([
            'id' => 'comment_create_upload_' . $id,
            'progress' => '#comment_create_upload_progress_' . $id,
            'preview' => '#comment_create_upload_preview_' . $id,
            'dropZone' => '#comment_create_form_'.$id,
            'max' => Yii::$app->getModule('content')->maxAttachedFiles
        ]);
        ?>

        <a href="#" class="btn btn-sm btn-default btn-comment-submit pull-left"
               data-action-click="submit"
               data-action-url="<?= Url::to(['/comment/comment/post']) ?>"
               data-ui-loader>
	        <?= Yii::t('CommentModule.widgets_views_form', 'Send') ?>
        </a>

    </div>
    </div>
    <?= Html::endForm(); ?>

    <div id="comment_create_upload_progress_<?= $id ?>" style="display:none;margin:10px 0px;"></div>

    <?=
    \humhub\modules\file\widgets\FilePreview::widget([
        'id' => 'comment_create_upload_preview_' . $id,
        'options' => ['style' => 'margin-top:10px'],
        'edit' => true
    ]);
    ?>

</div>

