<?php

use yii\helpers\Url;
use yii\helpers\Html;
use humhub\compat\CActiveForm;

$this->pageTitle = Yii::t('UserModule.views_auth_recoverPassword', 'Password recovery');
?>
<div class="container" style="text-align: center;">
	<?php $form = CActiveForm::begin(['id' => 'recovery-pass-form','enableClientValidation' => true]); ?>

    <div class="top">
        <div class="title">Password recovery</div>
    </div>
    <div class="center-block"><span><?php echo Yii::t('UserModule.views_auth_recoverPassword', 'Just enter your e-mail address. We´ll send you recovery instructions!'); ?></span>
        <div class="form-item"><label for="email"><?= Yii::t('UserModule.views_auth_recoverPassword', 'your email'); ?></label>
			<?php echo $form->textField($model, 'email', array('class' => 'form-control', 'id' => 'email_txt')); ?>
			<?php echo $form->error($model, 'email'); ?>
        </div><span>Enter code</span>
        <div class="form-group">
			<?php
			echo \yii\captcha\Captcha::widget([
				'model' => $model,
				'attribute' => 'verifyCode',
				'captchaAction' => '/user/auth/captcha',
				'id' => 'captcha',
				'options' => array('class' => 'form-control', 'placeholder' => Yii::t('UserModule.views_auth_recoverPassword', 'enter security code above'))
			]);
			?>

        </div>
	    <?= $form->error($model, 'verifyCode'); ?>
    </div>
    <div class="bottom">
        <div class="base-btn">
	        <?= Html::submitButton(Yii::t('UserModule.views_auth_recoverPassword', 'Reset password'), ['class' => 'btn btn-primary', 'data-ui-loader' => ""]); ?>
        </div>
    </div>


	<?php CActiveForm::end() ?>
</div>
