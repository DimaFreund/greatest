<?php

use yii\widgets\ActiveForm;
use yii\helpers\Url;
use humhub\modules\user\widgets\AuthChoice;
?>
















                    <?php if (AuthChoice::hasClients()): ?>
                        <?= AuthChoice::widget([]) ?>
                    <?php else: ?>
                        <?php if ($canRegister) : ?>
                            <p><?php echo Yii::t('UserModule.views_auth_login', "If you're already a member, please login with your username/email and password."); ?></p>
                        <?php else: ?>
                            <p><?php echo Yii::t('UserModule.views_auth_login', "Please login with your username/email and password."); ?></p>
                        <?php endif; ?>                    <?php endif; ?>

                    <?php $form = ActiveForm::begin(['enableClientValidation' => false, 'id' => 'login-form']); ?>

                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <button href="#" id="loginBtn" data-ui-loader type="submit" class="btn btn-primary" data-action-click="ui.modal.submit" data-action-url="<?= Url::to(['/user/auth/login']) ?>">
                                <?= Yii::t('UserModule.views_auth_login', 'Sign in') ?>
                            </button>

                        </div>
                        <div class="col-md-8 text-right">
                            <small>
                                <?= Yii::t('UserModule.views_auth_login', 'Forgot your password?'); ?>
                                <br/>
                                <a id="recoverPasswordBtn" href="#" data-action-click="ui.modal.load" data-action-url="<?= Url::to(['/user/password-recovery']) ?>">
                                    <?= Yii::t('UserModule.views_auth_login', 'Create a new one.') ?>
                                </a>
                            </small>
                        </div>
                    </div>
                    <div class="top">
                        <div class="title">LogIn</div>
                        <div class="link fb-login"><a href="#"><svg class="icon icon-facebook"><use xlink:href="./svg/sprite/sprite.svg#facebook"></use></svg><span>Log In with Facebook</span></a></div>
                        <div class="link google-login"><a class="google-login" href="#"><svg class="icon icon-google-plus-logo"><use xlink:href="./svg/sprite/sprite.svg#google-plus-logo"></use></svg><span>Log In with Google</span></a></div>
                    </div>
                    <div class="center-block"><span>or</span>
                        <div class="form-item"><label for="name"><?= Yii::t('UserModule.views_auth_login', 'username or email'); ?></label><?php echo $form->field($model, 'username')->textInput(['id' => 'name']); ?></div>
                        <div class="form-item"><label for="pass"><?= Yii::t('UserModule.views_auth_login', 'password') ?></label><?php echo $form->field($model, 'password')->passwordInput(['id' => 'pass']); ?></div>
                        <div class="form-checkbox"><?php echo $form->field($model, 'rememberMe', [
		                        'template' => '{input}', // Leave only input (remove label, error and hint)
		                        'options' => [
			                        'tag' => false, // Don't wrap with "form-group" div
		                        ]])->checkbox(['id' => 'remember', 'label' => false]); ?><label for="remember">Remember me</label></div>
                    </div>
                    <div class="bottom">
                        <div class="base-btn"><input type="submit" value="Login"></div><a class="newPass" href="#"><?= Yii::t('UserModule.views_auth_login', 'Forgot your password?'); ?></a>
                        <div class="signUp">
                            <p>Don't have an account?</p><a href="#">Sign Up</a></div>
                    </div>
                    <?php ActiveForm::end(); ?>




<script type="text/javascript">
    $(document).on('ready pjax:success', function () {
        $('#login_username').focus();

    });

    $('.tab-register a').on('shown.bs.tab', function (e) {
        $('#register-email').focus();
    })

    $('.tab-login a').on('shown.bs.tab', function (e) {
        $('#login_username').focus();
    })

</script>