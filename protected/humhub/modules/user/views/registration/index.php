<?php

use humhub\modules\user\widgets\AuthChoice;
use wbraganca\tagsinput\TagsinputWidget;
use yii\helpers\Html;

$this->pageTitle = Yii::t( 'UserModule.views_auth_createAccount', 'Create Account' );
?>

<main>
    <section class="createAcc-page">
		<?php $form = \yii\bootstrap\ActiveForm::begin( [ 'enableClientValidation' => false ] ); ?>
        <div class="top"><div class="base-wrap">
                <div class="item desire-text">
                    <div class="base-small-title"><?= Yii::t('UserModule.views_registration_index', 'Write your Greatest Desire'); ?></div>
                    <div class="sub-title"><?= Yii::t('UserModule.views_registration_index', 'Your desire will be the main criterion of search'); ?></div>
                    <div class="form-item <?php if($desire->hasErrors()) echo 'animated shake'; ?>">
	                    <?= $form->field($desire, 'title')->textarea(['maxlength' => true, 'id' => 'desire'])->label(Yii::t('UserModule.views_registration_index', 'My Desire is...')) ?>
                    </div>
                    <div class="sub-title"><?= Yii::t('UserModule.views_registration_index', 'Add tags to your desire. They will be the main tool for finding like-minded people.'); ?></div>
                    <div class="form-item">
                        <label for="tags" data-role="tagsinput">
	                        <?= Yii::t('UserModule.views_registration_index', 'My Greatest Desire is…'); ?>
                        </label>

	                    <?= $form->field($desire, 'tags')->widget(\humhub\modules\tags\widgets\Tagsinput::classname())->label(false);
	                    ?>
	                    <?php
	                    $script = <<< JS
	                     $('#desire-tags').on('beforeItemAdd', function(event) {
                                if (event.item.length < 3) {
                                    event.cancel = true;
                                }
                            });

JS;
	                    $this->registerJs($script);
	                    ?>
                    </div>
                </div>
                <div class="item desire-img"><img class="desc" src="<?= $this->theme->getBaseUrl(); ?>/img/public-profile-head.png"><img class="tabl" src="<?= $this->theme->getBaseUrl(); ?>/img/public-profile-head-2.png"></div>
            </div>
            <div class="regLink">
                <div class="title"><?= Yii::t('UserModule.views_registration_index', 'Сontinue with registration'); ?></div>
                <div class="link fb-login"><a data-pjax-prevent href="<?php echo $authUrl.'?authclient=facebook'; ?>"><svg class="icon icon-facebook"><use xlink:href="./svg/sprite/sprite.svg#facebook"></use></svg><span><?= Yii::t('UserModule.views_registration_index', 'Log In with Facebook'); ?></span></a></div>
                <div class="link google-login"><a data-pjax-prevent class="google-login" href="<?php echo $authUrl.'?authclient=google'; ?>"><svg class="icon icon-google-plus-logo"><use xlink:href="./svg/sprite/sprite.svg#google-plus-logo"></use></svg><span><?= Yii::t('UserModule.views_registration_index', 'Log In with Google'); ?></span></a></div>
            </div>
        </div>

            <div class="input-block">
                <div class="base-wrap">



                    <div class="title"><?= Yii::t('UserModule.views_registration_index', 'or Sign up with your email address'); ?></div>
	                <?= $hForm->render($form); ?>
                </div>
            </div>
            <div class="submited-block">
	            <?= $form->field($desire, 'verifyCode')->widget(
		            \himiklab\yii2\recaptcha\ReCaptcha::className()
	            )->label(false); ?>
                <div class="base-wrap">
                    <div class="title">
                        <?= $form->field($desire, 'agreePrivacyPolicy')->checkbox(['check' => false])->label(false); ?>
                        <?= Yii::t('UserModule.views_registration_index', 'By clicking on Sign up, you agree to our'); ?> <?= \yii\helpers\Html::a('Terms and Conditions', ['info/conditions'], ['data-pjax'=>0]) ?> and <?= \yii\helpers\Html::a('Privacy policy', ['info/policy'], ['data-pjax'=>0]) ?></div>
                    <div class="base-btn reverse">
                        <button type="submit" name="save" data-ui-loader=""><?= Yii::t('UserModule.views_registration_index', 'Continue'); ?></button>

                    </div>
                    <div class="sub-title"><?= Yii::t('UserModule.views_registration_index', 'Already have an account?'); ?><a href="#"><?= Yii::t('base', 'Log In'); ?></a></div>
                </div>
            </div>
			<?php \yii\bootstrap\ActiveForm::end(); ?>
    </section>
</main>



<script type="text/javascript">
    $(function () {
        // set cursor to login field
        $('#desire').focus();
    })


    $("form").keypress(function(e) {
        //Enter key
        if (e.which == 13) {
            return false;
        }
    });

</script>
