<?php

use humhub\modules\friendship\models\Friendship;
use yii\helpers\Url;

if ( $isProfileOwner) { ?>
    <li class="edit"><a class="link" href="<?= Url::to( [ '/user/account/edit' ] ); ?>">
            <svg class="icon icon-edit">
                <use xlink:href="./svg/sprite/sprite.svg#edit"></use>
            </svg>
            <div class="tooltip-base">Edit</div>
        </a></li>
<?php } else { ?>

    <?= \humhub\modules\friendship\widgets\FriendshipButton::widget(['object' => $user]); ?>
	<?= \humhub\modules\favorite\widgets\FavoriteLink::widget(['object' => $user]); ?>
    <li class="msg">

        <div class="link">
            <a href="<?= $urlGoMessage ?>">
                <svg class="icon icon-message">
                    <use xlink:href="./svg/sprite/sprite.svg#message"></use>
                </svg>
                <div class="tooltip-base">Message</div></a>
        </div>
    </li>
<?php } ?>
