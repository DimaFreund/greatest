<?php

use humhub\modules\friendship\assets\FriendshipAsset;
use yii\helpers\Html;
use yii\helpers\Url;
use humhub\modules\friendship\models\Friendship;

/* @var $user \humhub\modules\user\models\User */
/* @var $friendshipState string */
FriendshipAsset::register($this);
?>

<li data-action-click="friendship.toggleFriendship" data-action-url="<?= Url::to(['/friendship/request/add', 'userId' => $user->id]) ?>" style="<?= ($friendshipState === Friendship::STATE_NONE) ? '' : 'display:none'?>" class="add-friend friendship">
    <div class="link">
        <svg class="icon icon-friend">
            <use xlink:href="./svg/sprite/sprite.svg#friend"></use>
        </svg>
        <svg class="icon icon-unfriend">
            <use xlink:href="./svg/sprite/sprite.svg#unfriend"></use>
        </svg>
        <div class="tooltip-base">Add Friend</div>
        <div class="tooltip-base active">Unfriend</div>
    </div>
</li>

<li data-action-click="friendship.toggleFriendship" data-action-url="<?= Url::to(['/friendship/request/delete', 'userId' => $user->id]) ?>" style="<?= ($friendshipState !== Friendship::STATE_NONE) ? '' : 'display:none'?>" class="add-friend unfriendship active-item">
    <div class="link">
        <svg class="icon icon-friend">
            <use xlink:href="./svg/sprite/sprite.svg#friend"></use>
        </svg>
        <svg class="icon icon-unfriend">
            <use xlink:href="./svg/sprite/sprite.svg#unfriend"></use>
        </svg>
        <div class="tooltip-base">Add Friend</div>
        <div class="tooltip-base active">Unfriend</div>
    </div>
</li>
