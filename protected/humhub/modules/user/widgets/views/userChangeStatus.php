<?php

use \humhub\compat\CActiveForm;
use yii\helpers\Url;

?>
<?php $form = CActiveForm::begin( [ 'action' => URL::to( [ '/user/account/change-status' ] ) ] ); ?>
    <div class="form-item">
        <label for="status">Status message…</label>
		<?= $form->textArea( $model, 'info_status', [ 'onChange' => 'this.form.submit()' ] ); ?>
    </div>

<?php CActiveForm::end(); ?>