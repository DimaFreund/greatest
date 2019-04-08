<?php

use \humhub\compat\CActiveForm;
use yii\helpers\Url;

?>
    <?php if (count($languages) > 1) : ?>
        <div class="langSwitcher inline-block">
            <?php $form = CActiveForm::begin(['id' => false, 'action' => URL::to(['/user/account/change-language'])]); ?>
            <?= $form->dropDownList($model, 'language', $languages, ['onChange' => 'this.form.submit()', 'id' => false, 'class' => 'language-switcher','aria-label' => Yii::t('base', "Choose language:")]); ?>
            <?php CActiveForm::end(); ?>
        </div>
    <?php endif; ?>