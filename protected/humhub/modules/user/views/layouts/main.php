<?php

use yii\helpers\Html;
use humhub\assets\AppAsset;
use yii\helpers\Url;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?= Html::encode($this->pageTitle); ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="theme-color" content="#000">
        <link rel="shortcut icon" href="/<?= $this->theme->getBaseUrl(); ?>/img/favicon/apple-touch-icon.png">
        <link rel="stylesheet" href="<?= $this->theme->getBaseUrl(); ?>/css/main.min.css">
        <?php $this->head() ?>
        <?= $this->render('@humhub/views/layouts/head'); ?>

        <style>
            body {
                padding-top: 0px;
            }
        </style>

    </head>

    <body>


    <header class="<?= Yii::$app->params['class_body']; ?>">
        <div class="fixed-wrap">
            <div class="base-wrap"><a data-pjax="0" class="logo" href="<?= Url::to(['auth/login']); ?>"><svg class="icon icon-logo"><use xlink:href="<?= $this->theme->getBaseUrl(); ?>/svg/sprite/sprite.svg#logo"></use></svg></a>
                <div class="menu">
                    <ul id="navigation">
	                    <?php echo \humhub\modules\user\widgets\PublicTopMenu::widget(['page' => 'home']); ?>
                    </ul>
                </div>
                <div class="link-block">
                    <div class="base-btn"><a data-action-click="ui.modal.load"  href="#" data-action-url="/index.php/user/auth/login">Login</a></div>
                    <div class="base-btn reverse"><a data-pjax="0" href="<?php echo Url::to(['registration/']) ?>">Create Account</a></div>
                </div>
            </div>
        </div>
    </header>
    <?= Yii::$app->session->getFlash('error') ?>




        <?php $this->beginBody() ?>
        <?= $content; ?>
        <?php $this->endBody() ?>



    <footer>
        <div class="top">
            <div class="base-wrap">
                <a data-pjax="0" href="<?= Url::to(['auth/login']); ?>"><div class="logo"><svg class="icon icon-logo"><use xlink:href="<?= $this->theme->getBaseUrl(); ?>/svg/sprite/sprite.svg#logo"></use></svg></div></a>
                <div class="footer-menu">
                    <ul>
	                    <?php echo \humhub\modules\user\widgets\PublicTopMenu::widget(['page' => 'home']); ?>
                    </ul>
                </div>
                <div class="footer-form">
                    <? //TODO did send-form; ?>
<!--                    <form>-->
<!--                        <div class="form-item"><label for="footer-email">E-mail*</label><input id="footer-email" type="email"></div>-->
<!--                        <label>Message*<div class="textarea-wrap"><textarea rows="1"></textarea></div></label>-->
<!--                        <div class="base-sm-btn"><input type="submit" value="Send"></div>-->
<!--                    </form>-->
                </div>
            </div>
        </div>
        <div class="bottom">
            <div class="base-wrap">
                <div class="copy">© All rights reserved.</div>
                <div class="dev-logo"><a href="#"><svg class="icon icon-logo_footer"><use xlink:href="<?= $this->theme->getBaseUrl(); ?>/svg/sprite/sprite.svg#logo_footer"></use></svg></a></div>
            </div>
        </div>
    </footer>

    <script src="<?= $this->theme->getBaseUrl(); ?>/js/scripts.min.js"></script>
    </body>
</html>
<?php $this->endPage() ?>




