<?php 
use yii\helpers\Html;
?>

<?= Html::beginTag('span', $options) ?>
    <?= Yii::t('FileModule.widgets_views_fileUploadButton', 'Upload files') ?>
     <?= $label ?>
    <?= $input ?>
<?= Html::endTag('span') ?>