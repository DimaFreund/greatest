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
	<div class="user-info-top-block desires-page">
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
			            'height' => 370,
			            'width'  => 370,
		            ]
	            ] ); ?>
            </div>
			<div class="bottom">
				<div class="avatar-menu">
					<?= \humhub\modules\user\widgets\OnlineStatus::widget(['user' => $user]); ?>
					<div
						class="img-block"><img src="<?php echo $user->getProfileImage()->getUrl(); ?>"></div>
					<ul class="menu">
                        <?= \humhub\modules\user\widgets\UserButtons::widget(['user' => $user]); ?>
					</ul>
				</div>
			</div>
            <div class="mobile-toggle-btn"></div>
		</div>
	</div>
	<div class="user-info-menu">
		<?php echo \humhub\modules\user\widgets\ProfileMenu::widget( [ 'user' => $user ] ); ?>
	</div>
</div>

