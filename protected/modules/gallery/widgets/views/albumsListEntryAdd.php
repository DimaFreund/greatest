<?php
/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2015 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 * 
 * @package humhub.modules.gallery.views
 * @since 1.0
 * @author Sebastian Stumpf
 */
?>

<?php

use \humhub\modules\gallery\assets\Assets;

$bundle = Assets::register($this);
?>

<div class="album">
    <a class="title" <?= yii\bootstrap\Html::renderTagAttributes($htmlOptions) ?> href="<?= $addActionUrl ?>">
    <div class="img-block">
        <img src="<?= Yii::$app->getModule('gallery')->getAssetsUrl() . '/plus.svg' ?>">
    </div>
    </a>
    <div class="desc">
        <a class="title" <?= yii\bootstrap\Html::renderTagAttributes($htmlOptions) ?> href="<?= $addActionUrl ?>"><?= $title ?></a>

    </div>

</div>