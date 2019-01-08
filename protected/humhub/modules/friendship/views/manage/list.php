<?php

use humhub\modules\content\widgets\BottomPanelContent;
use humhub\modules\desire\models\Desire;
use humhub\widgets\LoadMoreButton;
use yii\helpers\Url;

?>

<div class="content-wrap">
    <div class="personal-profile-friends">
        <div class="title">Friends</div>
        <div class="friends-header">
            <div class="stat"><?= $count; ?> friends<span style="display: none;">(12 mutual)<?php //TODO add mutual friend count and mutal list friend ?></span></div>
            <div class="map-btn"><svg class="icon icon-location"><use xlink:href="./svg/sprite/sprite.svg#location"></use></svg>view on map</div>
            <div class="map-block"><iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d81217.46868235002!2d30.48229395!3d50.49610355!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sru!2sua!4v1526995954734" width="600" height="350" frameborder="0"
                                           style="border:0" allowfullscreen></iframe></div>
        </div>
        <ul id="list-object" class="friends-list">
            <?php foreach($friends as $friend) { ?>
            <li class="friend">
                <div class="photo"><a href="<?= $friend->createUrl('/user/profile/home'); ?>"><img src="<?= $friend->getProfileImage()->getUrl(); ?>"></a><span class="<?php if($friend->status_online === 1) echo 'active'; ?>"></span></div>
                <div class="user-wrap">
                    <div class="name"><a href="<?= $friend->createUrl('/user/profile/home'); ?>"><?= $friend->username; ?></a></div>
                    <?php $greatestDesire = Desire::getGreatestDesire($friend); ?>
                    <a href="<?= $friend->createUrl('/user/profile/desire-one', ['id' => $greatestDesire->id]); ?>"><div class="user-desire"><?= $greatestDesire->title; ?></div></a>
                    <div class="statistic-info">


                        <?= BottomPanelContent::widget([
                                'object' => $greatestDesire,
                                'mode' => BottomPanelContent::SMALL_MODE,
                                'ratingLink' => true,
                                'commentLinkPage' => true,
                                'options' => ['commentPageUrl' => '/user/profile/desire-one'],
                        ]); ?>

                    </div>
                </div>
                <ul class="menu">
	                <?= \humhub\modules\user\widgets\UserButtons::widget(['user' => $friend]); ?>
                </ul>
            </li>
            <?php } ?>
        </ul>

    </div>
    <?= LoadMoreButton::widget(['object' => $friends, 'count' => $count, 'user' => $user, 'ajaxUrl' => $ajaxUrl]); ?>
</div>

<div class="panel-body">
</div>



