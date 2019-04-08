<?php

use humhub\modules\friendship\models\Friendship;
use humhub\modules\tags\widgets\DisplayTags;
use yii\helpers\Html;
use yii\helpers\Url;
use humhub\modules\user\controllers\ImageController;
use yii\widgets\ActiveForm;

if ( $allowModifyProfileBanner || $allowModifyProfileImage ) {
	$this->registerJsFile( '@web-static/resources/user/profileHeaderImageUpload.js' );
	$this->registerJs( "var profileImageUploaderUserGuid='" . $user->guid . "';", \yii\web\View::POS_BEGIN );
	$this->registerJs( "var profileImageUploaderCurrentUserGuid='" . Yii::$app->user->getIdentity()->guid . "';", \yii\web\View::POS_BEGIN );
	$this->registerJs( "var profileImageUploaderUrl='" . Url::to( [
			'/user/image/upload',
			'userGuid' => $user->guid,
			'type'     => ImageController::TYPE_PROFILE_IMAGE
		] ) . "';", \yii\web\View::POS_BEGIN );
	$this->registerJs( "var profileHeaderUploaderUrl='" . Url::to( [
			'/user/image/upload',
			'userGuid' => $user->guid,
			'type'     => ImageController::TYPE_PROFILE_BANNER_IMAGE
		] ) . "';", \yii\web\View::POS_BEGIN );
}
?>


<div class="profile-top-block">
    <div class="user-info-top-block">

        <div class="desire-img">
			<?= \humhub\modules\file\widgets\ShowPhotoPreview::widget( [
				'object'  => $greatestDesire,
				'options' => [
					'index'  => 0,
					'height' => 370,
					'width'  => 370,
				]
			] ); ?>
			<?php if ( $isProfileOwner ) { ?>
                <a class="edit" href="<?= Url::to( [ '/desire/desire/update', 'id' => $greatestDesire->id ] ); ?>">

                    <svg class="icon icon-edit_desire_hover">
                        <use xlink:href="./svg/sprite/sprite.svg#edit_desire_hover"></use>
                    </svg>
                </a>
			<?php } ?>
        </div>
        <div class="info-short">
            <div class="top">
                <div class="name"><?= Html::encode( $user->displayName ); ?></div>
                <div class="subText"><?= $user->info_status; ?></div>
            </div>
            <div class="mobile-desire-img">
	            <?= \humhub\modules\file\widgets\ShowPhotoPreview::widget( [
		            'object'  => $user->greatestDesire,
		            'options' => [
			            'index'  => 0,
			            'height' => 519,
			            'width'  => 519,
		            ]
	            ] ); ?>
            </div>
            <div class="bottom">
                <div class="avatar-menu">

					<?= \humhub\modules\user\widgets\OnlineStatus::widget(['user' => $user]); ?>

                    <div class="img-block"><img src="<?php echo $user->getProfileImage()->getUrl(); ?>">
                        <svg class="icon icon-Oval-2">
                            <use xlink:href="./svg/sprite/sprite.svg#Oval-2"></use>
                        </svg>
                    </div>
                    <ul class="menu">
						<?= \humhub\modules\user\widgets\UserButtons::widget(['user' => $user]); ?>
                    </ul>
                </div>

                <div class="wrap">
                    <div class="desire-top">
                        <div class="title">
                            <svg class="icon icon-earth_green">
                                <use xlink:href="./svg/sprite/sprite.svg#earth_green"></use>
                            </svg>
                            <?= Yii::t('base','My Greatest Desire is'); ?>…
                        </div>
						<?= \humhub\modules\rating\widgets\RatingDisplay::widget(['object' => $greatestDesire]); ?>
                    </div>
                    <div class="desire-text">
                        <a href="<?= $user->createUrl('/user/profile/desire-one', ['id' => $greatestDesire->id]); ?>">
                            <div class="text"><?= $greatestDesire->title; ?></div>
                        </a>
                    </div>
                    <div class="mobile-wrap">
                        <ul class="tags">
							<?= DisplayTags::widget(['user' => $greatestDesire]); ?>
                        </ul>

                    <div class="desire-bottom">

						<?= \humhub\modules\comment\widgets\CommentLinkPage::widget(['object' => $greatestDesire, 'options' => ['commentPageUrl' => '/user/profile/desire-one']]); ?>
						<?= \humhub\modules\rating\widgets\RatingLink::widget(['object' => $greatestDesire]); ?>
						<?= \humhub\modules\sharebetween\widgets\ShareLink::widget(['object' => $greatestDesire]); ?>
                        <div class="stars">
							<?= \humhub\modules\favorite\widgets\FavoriteLink::widget(['object' => $greatestDesire]); ?>
                            <a class="text" href=" <?= $user->createUrl('/user/profile/desires'); ?>">
                                <?= Yii::t('base','View all desires'); ?></a>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            <div class="mobile-toggle-btn"></div>
        </div>
    </div>
    <div class="user-info-menu">
		<?php echo \humhub\modules\user\widgets\ProfileMenu::widget( [ 'user' => $user ] ); ?>

    </div>
</div>


