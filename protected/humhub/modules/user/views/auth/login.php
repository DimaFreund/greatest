<?php

use humhub\compat\CActiveForm;
use humhub\modules\user\widgets\AuthMenuTop;
use \yii\helpers\Url;
use yii\widgets\ActiveForm;
use \humhub\compat\CHtml;
use humhub\modules\user\widgets\AuthChoice;

$this->pageTitle = Yii::t('UserModule.views_auth_login', 'Login');
?>
<?php if (Yii::$app->session->hasFlash('error')): ?>
    <div class="alert alert-danger" role="alert">
		<?= Yii::$app->session->getFlash('error') ?>
    </div>
<?php endif; ?>





<main>

    <section class="front-top">
        <div class="wrap">
            <div class="base-img-slider">
                <?php foreach(unserialize($info->slides) as $item) { ?>
                <div class="item"><img src="<?php echo $item; ?>"></div>
                <?php } ?>
            </div>
            <div class="slider-text">
                <div class="text-wrap">
                    <div class="top">
                        <p class="first">Write your heart's desire, and find your destiny!</p>
                        <p class="second">Social network for meeting and socializing</p>
                    </div><svg class="icon icon-logo"><use xlink:href="<?= $this->theme->getBaseUrl(); ?>/svg/sprite/sprite.svg#logo"></use></svg>
                    <div class="link-block">
                        <div class="base-btn"><a class="loginPopUp" href="#login-form">Login</a></div>
                        <div class="base-btn reverse"><a data-pjax="0" href="<?php echo Url::to(['registration/']) ?>">Create Account</a></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

	<?php $form = ActiveForm::begin(['id' => 'login-form', 'options' => ['class' => 'mfp-hide'], 'enableClientValidation' => false]); ?>
        <div class="top">
            <div class="title">LogIn</div>
            <div class="link fb-login"><a data-pjax-prevent href="<?php echo $authUrl.'?authclient=facebook'; ?>"><svg class="icon icon-facebook"><use xlink:href="<?= $this->theme->getBaseUrl(); ?>/svg/sprite/sprite.svg#facebook"></use></svg><span>Log In with Facebook</span></a></div>
            <div class="link google-login"><a data-pjax-prevent class="google-login" href="<?php echo $authUrl.'?authclient=google'; ?>"><svg class="icon icon-google-plus-logo"><use xlink:href="<?= $this->theme->getBaseUrl(); ?>/svg/sprite/sprite.svg#google-plus-logo"></use></svg><span>Log In with Google</span></a></div>
        </div>
        <div class="center-block"><span>or</span>
            <div class="form-item"><label for="name"><?= Yii::t('UserModule.views_auth_login', 'username or email'); ?></label><?php echo $form->field($model, 'username')->textInput(['id' => 'name']); ?></div>
            <div class="form-item"><label for="name"><?= Yii::t('UserModule.views_auth_login', 'password') ?></label><?php echo $form->field($model, 'password')->passwordInput(['id' => 'pass']); ?></div>
            <div class="form-checkbox"><?php echo $form->field($model, 'rememberMe', [
			        'template' => '{input}', // Leave only input (remove label, error and hint)
			        'options' => [
				        'tag' => false, // Don't wrap with "form-group" div
			        ]])->checkbox(['id' => 'remember', 'label' => false]); ?><label for="remember">Remember me</label></div>
        </div>
        <div class="bottom">
            <div class="base-btn"><input type="submit" value="Login"></div><a class="newPass" data-pjax-prevent href="<?= Url::toRoute('/user/password-recovery'); ?>"><?= Yii::t('UserModule.views_auth_login', 'Forgot your password?'); ?></a>
            <div class="signUp">
                <p>Don't have an account?</p><a href="<?php echo Url::to(['registration/']) ?>">Sign Up</a></div>

        </div>
	<?php ActiveForm::end(); ?>


	<?php $form = CActiveForm::begin(['id' => 'recovery-pass-form', 'options' => ['class' => 'mfp-hide'], 'enableClientValidation' => true]); ?>

        <div class="top">
            <div class="title">Password recovery</div>
        </div>
        <div class="center-block"><span><?php echo Yii::t('UserModule.views_auth_recoverPassword', 'Just enter your e-mail address. We´ll send you recovery instructions!'); ?></span>
            <div class="form-item"><label for="email"><?= Yii::t('UserModule.views_auth_recoverPassword', 'your email'); ?></label>
	            <?php echo $form->textField($recoverPassword, 'email', array('class' => 'form-control', 'id' => 'email_txt')); ?>
	            <?php echo $form->error($recoverPassword, 'email'); ?>
            </div><span>Enter code</span>
            <div class="form-group">
	            <?php
	            echo \yii\captcha\Captcha::widget([
		            'model' => $recoverPassword,
		            'attribute' => 'verifyCode',
		            'captchaAction' => '/user/auth/captcha',
		            'id' => 'captcha',
		            'options' => array('class' => 'form-control', 'placeholder' => Yii::t('UserModule.views_auth_recoverPassword', 'enter security code above'))
	            ]);
	            ?>
            </div>
        </div>
        <div class="bottom">
            <div class="base-btn"><a data-action-click="ui.modal.submit" data-action-url="<?= Url::to(['/user/password-recovery']) ?>" data-ui-loader type="submit" value="<?= Yii::t('UserModule.views_auth_recoverPassword', 'Reset password') ?>"><?= Yii::t('UserModule.views_auth_recoverPassword', 'Reset password') ?></a></div>
        </div>


	<?php CActiveForm::end() ?>
    <section class="front-short-info">
        <div class="base-wrap">
            <h1 class="base-small-title">Welcome to Greatest Desire social network!</h1>
            <div class="sub-title">Write your heart's desire, and find your destiny!</div>
            <div class="wrap">
                <div class="item">
                    <div class="img-block"><svg class="icon icon-icon-1"><use xlink:href="<?= $this->theme->getBaseUrl(); ?>/svg/sprite/sprite.svg#icon-1"></use></svg></div>
                    <div class="number"><?= $info->totalRegisters; ?></div>
                    <div class="desc">TOTAL REGISTERED MEMBERS</div>
                </div>
                <div class="item">
                    <div class="img-block"><svg class="icon icon-icon-2"><use xlink:href="<?= $this->theme->getBaseUrl(); ?>/svg/sprite/sprite.svg#icon-2"></use></svg></div>
                    <div class="number"><?= $info->conceivedDesires; ?></div>
                    <div class="desc">TOTAL conceived desires</div>
                </div>
                <div class="item">
                    <div class="img-block"><svg class="icon icon-icon-3"><use xlink:href="<?= $this->theme->getBaseUrl(); ?>/svg/sprite/sprite.svg#icon-3"></use></svg></div>
                    <div class="number"><?= $info->successStories; ?></div>
                    <div class="desc">success stories</div>
                </div>
            </div>
        </div>
    </section>
    <section class="front-work">
        <div class="bg-block"><img src="/uploads/admin_files/<?= $info->imageHowWork; ?>"></div>
        <div class="base-wrap">
            <div class="scheme">
                <div class="base-small-title white">How it works</div>
                <div class="wrap">
                    <div class="item">
                        <div class="title">step 1</div>
                        <div class="text">Register<br> profile</div>
                    </div>
                    <div class="item">
                        <div class="title">step 2</div>
                        <div class="text">Write your heart's<br> desire in your profile</div>
                    </div>
                    <div class="item">
                        <div class="title">step 3</div>
                        <div class="text">Search for friends by interests,<br> meet and communicate</div>
                    </div>
                </div>
                <div class="base-btn reverse"><a data-pjax="0" href="<?php echo Url::to(['registration/']) ?>">Create Account</a></div>
            </div>
            <div class="testimonials">
                <div class="base-small-title">Testimonials</div>
                <div class="wrap">
                    <div class="item">
                        <div class="photo"><img src="/uploads/admin_files/<?= $info->imageTestimonials1; ?>"></div>
                        <div class="name"><?= $info->firstTestimonials; ?></div>
                        <div class="desc"><?= $info->firstTestimonialsText; ?></div>
                    </div>
                    <div class="item">
                        <div class="photo"><img src="/uploads/admin_files/<?= $info->imageTestimonials2; ?>"></div>
                        <div class="name"><?= $info->twoTestimonials; ?></div>
                        <div class="desc"><?= $info->twoTestimonialsText; ?></div>
                    </div>
                    <div class="item">
                        <div class="photo"><img src="/uploads/admin_files/<?= $info->imageTestimonials3; ?>"></div>
                        <div class="name"><?= $info->threeTestimonials; ?></div>
                        <div class="desc"><?= $info->threeTestimonialsText; ?></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="front-success-stories success-stories"><img src="/uploads/admin_files/<?= $info->successStoriesBackground; ?>">
        <div class="base-wrap">
            <div class="base-small-title white">Success stories</div>
            <div class="items-wrap">
	            <?php foreach($stories as $item){ ?>
                    <a class="item" href="<?= Url::toRoute(['info/view', 'id'=>$item->attributes['id']]); ?>">
                    <div class="item-img"><img src="/uploads/admin_files/<?php echo $item->attributes['image']; ?>"></div>
                    <div class="wrap">
                        <div class="title"><?php echo $item->attributes['title']; ?></div>
                        <div class="desc"><?php echo $item->attributes['description']; ?></div>
                        <div class="link">more</div>
                    </div>
                    </a>
	            <?php } ?>
            </div>
            <div class="base-btn reverse"><a href="/index.php/user/info">View All</a></div>
        </div>
    </section>
</main>


