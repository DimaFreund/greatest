<?php

use yii\helpers\Html;

humhub\modules\like\assets\LikeAsset::register( $this );
?>
<?php if ( ! $mode ) { ?>
    <div class="like likeLinkContainer" id="likeLinkContainer_<?= $id ?>">

        <div href="#" data-action-click="like.toggleLike" data-action-url="<?= $likeUrl ?>"
             class="liked likeAnchor" style="<?= ( ! $currentUserLiked ) ? '' : 'display:none' ?>">
            <svg class="icon icon-like"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="./svg/sprite/sprite.svg#like"></use></svg>
            <div class="text">
			<?= Yii::t( 'LikeModule.widgets_views_likeLink', 'Like' ) ?>
            </div>
        </div>
        <div href="#" data-action-click="like.toggleLike" data-action-url="<?= $unlikeUrl ?>"
             class="unliked likeAnchor" style="<?= ( $currentUserLiked ) ? '' : 'display:none' ?>">
            <svg class="icon icon-liked"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="./svg/sprite/sprite.svg#liked"></use></svg>
            <div class="text">
			<?= Yii::t( 'LikeModule.widgets_views_likeLink', 'Unlike' ) ?>
            </div>
        </div>


		<?php if ( count( $likes ) > 0 ) { ?>
            <!-- Create link to show all users, who liked this -->
            <div class="val likeCount">(<span><?= count( $likes ) ?></span>)</div>
		<?php } else { ?>
            <div class="val likeCount"></div>
		<?php } ?>
    </div>

<?php } else { ?>
    <div id="likeLinkContainer_<?= $id ?>">
        <div data-action-click="like.toggleLike" data-action-url="<?= $likeUrl ?>"
             class="thumbUp liked likeAnchor text" style="<?= ( ! $currentUserLiked ) ? '' : 'display:none' ?>">
            <svg class="icon icon-liked">
                <use xlink:href="./svg/sprite/sprite.svg#liked"></use>
            </svg>

	        <?php if ( count( $likes ) > 0 ) { ?>
                <!-- Create link to show all users, who liked this -->
                <div class="val likeCount">(<span><?= count( $likes ) ?></span>)</div>
	        <?php } else { ?>
                <div class="val likeCount"></div>
	        <?php } ?>
        </div>

        <div data-action-click="like.toggleLike" data-action-url="<?= $unlikeUrl ?>"
             class="thumbUp unliked likeAnchor text" style="<?= (  $currentUserLiked ) ? '' : 'display:none' ?>">
            <svg class="icon icon-liked">
                <use xlink:href="./svg/sprite/sprite.svg#liked"></use>
            </svg>

		    <?php if ( count( $likes ) > 0 ) { ?>
                <!-- Create link to show all users, who liked this -->
                <div class="val likeCount">(<span><?= count( $likes ) ?></span>)</div>
		    <?php } else { ?>
                <div class="val likeCount"></div>
		    <?php } ?>
        </div>
    </div>
<?php } ?>
