<?php

use humhub\compat\CActiveForm;
use humhub\modules\file\widgets\FilePreview;
use humhub\widgets\Button;
use humhub\widgets\RichtextField;

$submitUrl = $news->content->container->createUrl('/news/news/edit', ['id' => $news->id]);

?>
<div class="content content_edit" id="news_edit_<?php echo $news->id; ?>">
    <?php $form = CActiveForm::begin(['id' => 'news-edit-form_' . $news->id]); ?>

    <!-- create contenteditable div for HEditorWidget to place the data -->
    <?= RichtextField::widget([
        'id' => 'news_input_'. $news->id,
        'placeholder' => Yii::t('NewsModule.views_edit', 'Edit your news...'),
        'model' => $news,
        'attribute' => 'message'
    ]); ?>

    <div class="comment-buttons">

        <?=
        \humhub\modules\file\widgets\UploadButton::widget([
            'id' => 'news_upload_' . $news->id,
            'model' => $news,
            'dropZone' => '#news_edit_' . $news->id . ':parent',
            'preview' => '#news_upload_preview_' . $news->id,
            'progress' => '#news_upload_progress_' . $news->id,
            'max' => Yii::$app->getModule('content')->maxAttachedFiles
        ])
        ?>

        <!-- editSubmit action of surrounding StreamEntry component -->
        <?= Button::defaultType(Yii::t('base', 'Save'))->action('editSubmit', $submitUrl)->submit()->cssClass(' btn-comment-submit')->sm(); ?>

    </div>

    <div id="news_upload_progress_<?= $news->id ?>" style="display:none;margin:10px 0px;"></div>

    <?=
    FilePreview::widget([
        'id' => 'news_upload_preview_' . $news->id,
        'options' => ['style' => 'margin-top:10px'],
        'model' => $news,
        'edit' => true
    ])
    ?>

<?php CActiveForm::end(); ?>
</div>