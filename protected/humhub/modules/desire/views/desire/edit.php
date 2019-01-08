<?php

use humhub\compat\CActiveForm;
use humhub\modules\file\widgets\FilePreview;
use humhub\widgets\Button;
use humhub\widgets\RichtextField;

$submitUrl = $desire->content->container->createUrl('/desire/desire/edit', ['id' => $desire->id]);

?>
<div class="content content_edit" id="desire_edit_<?php echo $desire->id; ?>">
    <?php $form = CActiveForm::begin(['id' => 'desire-edit-form_' . $desire->id]); ?>

    <!-- create contenteditable div for HEditorWidget to place the data -->
    <?= RichtextField::widget([
        'id' => 'desire_input_'. $desire->id,
        'placeholder' => Yii::t('DesireModule.views_edit', 'Edit your desire...'),
        'model' => $desire,
        'attribute' => 'message'
    ]); ?>

    <div class="comment-buttons">

        <?=
        \humhub\modules\file\widgets\UploadButton::widget([
            'id' => 'desire_upload_' . $desire->id,
            'model' => $desire,
            'dropZone' => '#desire_edit_' . $desire->id . ':parent',
            'preview' => '#desire_upload_preview_' . $desire->id,
            'progress' => '#desire_upload_progress_' . $desire->id,
            'max' => Yii::$app->getModule('content')->maxAttachedFiles
        ])
        ?>

        <!-- editSubmit action of surrounding StreamEntry component -->
        <?= Button::defaultType(Yii::t('base', 'Save'))->action('editSubmit', $submitUrl)->submit()->cssClass(' btn-comment-submit')->sm(); ?>

    </div>

    <div id="desire_upload_progress_<?= $desire->id ?>" style="display:none;margin:10px 0px;"></div>

    <?=
    FilePreview::widget([
        'id' => 'desire_upload_preview_' . $desire->id,
        'options' => ['style' => 'margin-top:10px'],
        'model' => $desire,
        'edit' => true
    ])
    ?>

<?php CActiveForm::end(); ?>
</div>