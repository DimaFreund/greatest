<?php
/**
 * Created by PhpStorm.
 * User: work
 * Date: 21.08.18
 * Time: 11:27
 */

use humhub\modules\file\widgets\ShowPhotoPreview;

?>

<div class="add-friends-post user-info-block">
    <div class="desire-img">

        <a href="<?= $source->createUrl( '/user/profile/desire-one', [ 'id' => $source->greatestDesire->id ] ); ?>">
			<?= ShowPhotoPreview::widget( [
				'object'  => $source->greatestDesire,
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
            <div class="name"><a href="<?= $source->createUrl(); ?>"><?= $source->username ?></a></div>
			<?= \humhub\modules\rating\widgets\RatingDisplay::widget( [ 'object' => $source->greatestDesire ] ); ?>
        </div>
        <div class="bottom">
            <div class="img-block"><a href="<?= $source->createUrl(); ?>"><img
                            src="<?= $source->getProfileImage()->getUrl(); ?>"></a></div>
            <div class="wrap">
                <a href="<?= $source->createUrl( '/user/profile/desire-one', [ 'id' => $source->greatestDesire->id ] ); ?>">
                    <div class="desire-text">
                        <svg class="icon icon-earth_green">
                            <use xlink:href="./svg/sprite/sprite.svg#earth_green"></use>
                        </svg>
                        <div class="text"><a href="<?= $source->createUrl( '/user/profile/desire-one', [ 'id' => $source->greatestDesire->id ] ); ?>"><?= $source->greatestDesire->title; ?></a></div>
                    </div>
                </a>
                <div class="desire-bottom">
	                <?= \humhub\modules\content\widgets\BottomPanelContent::widget([
		                'object' => $source->greatestDesire,
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
