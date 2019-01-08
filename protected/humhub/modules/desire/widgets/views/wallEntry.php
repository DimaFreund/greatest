<?php
use humhub\modules\file\widgets\ShowPhotoPreview;
use humhub\modules\rating\widgets\RatingDisplay;

?>

<div class="update-desire-post user-info-block">
    <div class="desire-img">
        <a href="<?= $desire->user->createUrl( '/user/profile/desire-one', [ 'id' => $desire->id ] ); ?>">
			<?= ShowPhotoPreview::widget( [
				'object'  => $desire,
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
            <div class="name"><?= $desire->user->displayName; ?></div>
			<?= RatingDisplay::widget( [ 'object' => $desire ] ); ?>
        </div>
        <div class="bottom">
            <div class="wrap">
                <div class="desire-text"><svg class="icon icon-earth_green"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="./svg/sprite/sprite.svg#earth_green"></use></svg>
                    <div class="text">
                        <a href="<?= $desire->user->createUrl( '/user/profile/desire-one', [ 'id' => $desire->id ] ); ?>">
							<?= $desire->title; ?>
                        </a>
                    </div>
                </div>
                <div class="desire-bottom">
					<?= \humhub\modules\content\widgets\BottomPanelContent::widget([
						'object' => $desire,
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

