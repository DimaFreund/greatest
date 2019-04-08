<?php
/**
 * Created by PhpStorm.
 * User: work
 * Date: 20.04.18
 * Time: 18:21
 */
?>


    <li><?= \yii\helpers\Html::a(Yii::t('UserModule.widget_views_public_top_menu', 'Discover more about network'), ['/user/info/anetwork'], ['data-pjax'=>0]) ?></li>
    <li><?= \yii\helpers\Html::a(Yii::t('UserModule.widget_views_public_top_menu', 'Privacy policy'), ['/user/info/policy'], ['data-pjax'=>0]) ?></li>
    <li><?= \yii\helpers\Html::a(Yii::t('UserModule.widget_views_public_top_menu', 'Terms and Conditions'), ['/user/info/conditions'], ['data-pjax'=>0]) ?></li>
    <li><?= \yii\helpers\Html::a('<li>' . Yii::t('UserModule.widget_views_public_top_menu', 'Success stories') . '</li>', ['/user/info'], ['data-pjax'=>1]) ?></li>
    <li><?= \yii\helpers\Html::a('<li>' . Yii::t('UserModule.widget_views_public_top_menu', 'FAQ') . '</li>', ['/user/info/faq'], ['data-pjax'=>0]) ?></li>
    <li><?= \yii\helpers\Html::a('<li>' . Yii::t('base', 'Contact Us') . '</li>', ['/user/info/contact'], ['data-pjax'=>0]) ?></li>
