<?php
/**
 * Created by PhpStorm.
 * User: work
 * Date: 11.06.18
 * Time: 18:39
 */
humhub\modules\favorite\assets\FavoriteAsset::register( $this );
?>
<div class="stars">
    <?php if(!$mode) { ?>
	<?php if ( $formatUser ) { ?>
        <li data-action-click="favorite.toggleFavorite" data-action-url="<?= $favoriteUrl ?>"
            style="<?= ( ! $currentUserFavorited ) ? '' : 'display:none' ?>" class="follow favorite">
            <div class="link">
                <svg class="icon icon-follow">
                    <use xlink:href="./svg/sprite/sprite.svg#follow"></use>
                </svg>
                <svg class="icon icon-followed">
                    <use xlink:href="./svg/sprite/sprite.svg#followed"></use>
                </svg>
                <div class="tooltip-base">Follow</div>
                <div class="tooltip-base active">Unfollow</div>
            </div>
        </li>
        <li data-action-click="favorite.toggleFavorite" data-action-url="<?= $unfavoriteUrl ?>"
            style="<?= ( $currentUserFavorited ) ? '' : 'display:none' ?>" class="follow unfavorite active-item">
            <div class="link">
                <svg class="icon icon-follow">
                    <use xlink:href="./svg/sprite/sprite.svg#follow"></use>
                </svg>
                <svg class="icon icon-followed">
                    <use xlink:href="./svg/sprite/sprite.svg#followed"></use>
                </svg>
                <div class="tooltip-base">Follow</div>
                <div class="tooltip-base active">Unfollow</div>
            </div>
        </li>
	<?php } else { ?>
        <div data-action-click="favorite.toggleFavorite" data-action-url="<?= $favoriteUrl ?>"
             style="<?= ( ! $currentUserFavorited ) ? '' : 'display:none' ?>" class="follow-btn favorite">
            <svg class="icon icon-star_fill">
                <use xlink:href="./svg/sprite/sprite.svg#star_fill"></use>
            </svg>
            <svg class="icon icon-star_empty">
                <use xlink:href="./svg/sprite/sprite.svg#star_empty"></use>
            </svg>
        </div>
        <div data-action-click="favorite.toggleFavorite" data-action-url="<?= $unfavoriteUrl ?>"
             style="<?= ( $currentUserFavorited ) ? '' : 'display:none' ?>" class="follow-btn active-item unfavorite">
            <svg class="icon icon-star_fill">
                <use xlink:href="./svg/sprite/sprite.svg#star_fill"></use>
            </svg>
            <svg class="icon icon-star_empty">
                <use xlink:href="./svg/sprite/sprite.svg#star_empty"></use>
            </svg>
        </div>
	<?php } ?>
    <?php } else { ?>
        <div data-action-click="favorite.toggleFavorite" data-action-url="<?= $favoriteUrl ?>" style="<?= ( ! $currentUserFavorited ) ? '' : 'display:none' ?>" class="favorite">
        <svg class="icon icon-star_fill">
            <use xlink:href="./svg/sprite/sprite.svg#star_empty"></use>
        </svg>
        </div>

        <div data-action-click="favorite.toggleFavorite" data-action-url="<?= $unfavoriteUrl ?>"
             style="<?= ( $currentUserFavorited ) ? '' : 'display:none' ?>" class="follow unfavorite active-item">
            <svg class="icon icon-star_fill">
                <use xlink:href="./svg/sprite/sprite.svg#star_fill"></use>
            </svg>
        </div>
    <?php } ?>
</div>

