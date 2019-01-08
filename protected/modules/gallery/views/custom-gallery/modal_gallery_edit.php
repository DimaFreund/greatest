<?php
/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2015 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 * 
 * @package humhub.modules.gallery.views
 * @since 1.0
 * @author Sebastian Stumpf
 */

/* @var $galleryForm \humhub\modules\gallery\models\forms\GalleryEditForm */
?>

<?php
\humhub\widgets\ModalDialog::begin([
    'header' => $galleryForm->instance->isNewRecord ? Yii::t('GalleryModule.base', '<strong>Add</strong> new gallery') : Yii::t('GalleryModule.base', '<strong>Edit</strong> gallery'),
    'animation' => 'fadeIn',
    'size' => 'small']);
?>
    <?php $form = \yii\bootstrap\ActiveForm::begin(['id' => 'Gallery', 'class' => 'form-horizontal']); ?>

        <div class="modal-body">
            <select name="album" id="album-choice">
                <option value="new">Create new Album</option>
                <?php foreach( $listGallery as $gallery) { ?>
                    <option value="<?= $this->context->contentContainer->createUrl('/gallery/custom-gallery/view', ['openGalleryId' => $gallery->id. '#.jpeg']); ?>"><?= $gallery->title; ?></option>
                <?php } ?>
            </select>
            <div id="fields-for-create">
                <?= $form->field($galleryForm->instance, 'title'); ?>
                <?= $form->field($galleryForm->instance, 'description')->textArea(); ?>
                <?= $form->field($galleryForm, 'visibility')->checkbox(['label' => Yii::t('GalleryModule.base', 'Make this gallery public')])?>
                <?= $form->field($galleryForm->instance, 'category')->dropDownList($category); ?>
            </div>
        </div>

        <div class="modal-footer">
            <button id="create-gallery-button" class="btn btn-primary" data-action-click="ui.modal.submit" data-ui-loader type="submit"
                    data-action-url="<?= $contentContainer->createUrl('/gallery/custom-gallery/edit', ['itemId' => $galleryForm->instance->getItemId()]) ?>">
                        <?= \Yii::t('GalleryModule.base', 'Save'); ?>
            </button>
            <button type="button" class="btn btn-primary" data-modal-close>
                <?= \Yii::t('GalleryModule.base', 'Close'); ?>
            </button>
        </div>
    <?php \yii\bootstrap\ActiveForm::end(); ?>
<?php \humhub\widgets\ModalDialog::end(); ?>


<script>
    $('#album-choice').change(function () {
        var value = $(this).val();
        var fields = $('#fields-for-create');
        if(value === 'new') {
            fields.css('display', 'block');
            $('#create-gallery-button').html('<?= \Yii::t('GalleryModule.base', 'Save'); ?>');
        } else {
            fields.css('display', 'none');
            $('#create-gallery-button').html('open');
        }
    })

    $('#create-gallery-button').on('click', function () {
        var value = $('#album-choice').val();
        if(value !== 'new') {
            window.location.href = value;
            return false;
        }
    })
</script>
