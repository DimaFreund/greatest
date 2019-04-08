<?php

use humhub\compat\CActiveForm;
use humhub\modules\file\widgets\FilePreview;
use humhub\widgets\Button;
use humhub\widgets\RichtextField;

$submitUrl = $blog->content->container->createUrl('/blog/blog/edit', ['id' => $blog->id]);

?>
<div class="content content_edit" id="blog_edit_<?php echo $blog->id; ?>">
    <?php $form = CActiveForm::begin(['id' => 'blog-edit-form_' . $blog->id]); ?>

    <!-- create contenteditable div for HEditorWidget to place the data -->
    <?= RichtextField::widget([
        'id' => 'blog_input_'. $blog->id,
        'placeholder' => Yii::t('BlogModule.views_edit', 'Edit your blog...'),
        'model' => $blog,
        'attribute' => 'message'
    ]); ?>

    <div class="comment-buttons">

        <?=
        \humhub\modules\file\widgets\UploadButton::widget([
            'id' => 'blog_upload_' . $blog->id,
            'model' => $blog,
            'dropZone' => '#blog_edit_' . $blog->id . ':parent',
            'preview' => '#blog_upload_preview_' . $blog->id,
            'progress' => '#blog_upload_progress_' . $blog->id,
            'max' => Yii::$app->getModule('content')->maxAttachedFiles
        ])
        ?>

        <!-- editSubmit action of surrounding StreamEntry component -->
        <?= Button::defaultType(Yii::t('base', 'Save'))->action('editSubmit', $submitUrl)->submit()->cssClass(' btn-comment-submit')->sm(); ?>

    </div>

    <div id="blog_upload_progress_<?= $blog->id ?>" style="display:none;margin:10px 0px;"></div>

    <?=
    FilePreview::widget([
        'id' => 'blog_upload_preview_' . $blog->id,
        'options' => ['style' => 'margin-top:10px'],
        'model' => $blog,
        'edit' => true
    ])
    ?>

<?php CActiveForm::end(); ?>
</div>