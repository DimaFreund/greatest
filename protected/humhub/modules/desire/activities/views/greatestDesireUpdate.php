<?php
/**
 * Created by PhpStorm.
 * User: work
 * Date: 21.08.18
 * Time: 15:42
 */

use humhub\modules\file\widgets\ShowPhotoPreview;
use humhub\modules\rating\widgets\RatingDisplay;

?>
<div class="update-desire-post user-info-block">
	<div class="desire-img">
        <a href="<?= $source->user->createUrl( '/user/profile/desire-one', [ 'id' => $source->id ] ); ?>">
			<?= ShowPhotoPreview::widget( [
				'object'  => $source,
				'options' => [
					'width'  => 120,
					'height' => 120,
					'index'  => 0
				]
			] ); ?>
        </a>
    </div>
	<div class="info-short">
		<div class="top">
			<div class="name"><?= $source->user->displayName; ?></div>
			<?= RatingDisplay::widget( [ 'object' => $source ] ); ?>
        </div>
		<div class="bottom">
			<div class="wrap">
				<div class="desire-text"><svg class="icon icon-earth_green"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="./svg/sprite/sprite.svg#earth_green"></use></svg>
					<div class="text">
                        <a href="<?= $source->user->createUrl( '/user/profile/desire-one', [ 'id' => $source->id ] ); ?>">
							<?= $source->title; ?>
                        </a>
                    </div>
				</div>
				<div class="desire-bottom">
                    <?= \humhub\modules\content\widgets\BottomPanelContent::widget([
						'object' => $source,
						'ratingLink' => true,
						'options' => [
							'commentPageUrl' => '/user/profile/desire-one'
						]
					]); ?>
				</div>
			</div>
		</div>
	</div>
</div>

