<?php

use \humhub\compat\CActiveForm;
use yii\helpers\Url;

?>
<?php $form = \yii\widgets\ActiveForm::begin( [ 'action' => URL::to( [ '/user/account/change-status' ] ), 'enableClientValidation' => true, 'enableClientScript' => true ] ); ?>
    <div class="form-item">
        <label for="status"><?= Yii::t('base', 'Status message…'); ?></label>
		<?= $form->field( $model, 'info_status')->textarea([ 'onChange' => 'this.form.submit()' ] )->label(false); ?>
    </div>

<?php \yii\widgets\ActiveForm::end(); ?>