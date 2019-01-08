<?php
/**
 * Created by PhpStorm.
 * User: work
 * Date: 05.07.18
 * Time: 15:22
 */

use humhub\modules\user\controllers\ImageController;
use yii\helpers\Url;

if ($allowModifyProfileImage) {
	$this->registerJsFile('@web-static/resources/user/profileHeaderImageUpload.js');
	$this->registerJs("var profileImageUploaderUserGuid='" . $user->guid . "';", \yii\web\View::POS_BEGIN);
	$this->registerJs("var profileImageUploaderCurrentUserGuid='" . Yii::$app->user->getIdentity()->guid . "';", \yii\web\View::POS_BEGIN);
	$this->registerJs("var profileImageUploaderUrl='" . Url::to(['/user/image/upload', 'userGuid' => $user->guid, 'type' => ImageController::TYPE_PROFILE_IMAGE]) . "';", \yii\web\View::POS_BEGIN);
	$this->registerJs("var profileHeaderUploaderUrl='" . Url::to(['/user/image/upload', 'userGuid' => $user->guid, 'type' => ImageController::TYPE_PROFILE_BANNER_IMAGE]) . "';", \yii\web\View::POS_BEGIN);
}
?>

<div class="image-upload-container profile-user-photo-container" style="width: 98px; height: 98px;">

	<?php if ($user->profileImage->hasImage()) : ?>
		<a data-ui-gallery="profileHeader"  href="<?= $user->profileImage->getUrl('_org'); ?>">
			<img class="img-rounded profile-user-photo" id="user-profile-image"
			     src="<?php echo $user->getProfileImage()->getUrl(); ?>"
			     data-src="holder.js/140x140" alt="140x140" style="width: 98px; height: 98px;"/>
		</a>
	<?php else : ?>
		<img class="img-rounded profile-user-photo" id="user-profile-image"
		     src="<?php echo $user->getProfileImage()->getUrl(); ?>"
		     data-src="holder.js/140x140" alt="140x140" style="width: 98px; height: 98px;"/>
	<?php endif; ?>

	<!-- check if the current user is the profile owner and can change the images -->
	<?php if ($allowModifyProfileImage) : ?>


		<div class="image-upload-loader" id="profile-image-upload-loader" style="padding-top: 60px;">
			<div class="progress image-upload-progess-bar" id="profile-image-upload-bar">
				<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="00"
				     aria-valuemin="0"
				     aria-valuemax="100" style="width: 0%;">
				</div>
			</div>
		</div>

		<div class="image-upload-buttons" id="profile-image-upload-buttons">
			<a  onclick="javascript:$('#profilefileupload input').click();" class="btn btn-info btn-sm" aria-label="<?= Yii::t('UserModule.base', 'Upload profile image'); ?>">
				<i class="fa fa-cloud-upload"></i>
			</a>
			<a id="profile-image-upload-edit-button"
			   style="<?php
			   if (!$user->getProfileImage()->hasImage()) {
				   echo 'display: none;';
			   }
			   ?>"
			   href="<?php echo Url::to(['/user/image/crop', 'userGuid' => $user->guid, 'type' => ImageController::TYPE_PROFILE_IMAGE]); ?>"
			   class="btn btn-info btn-sm" data-target="#globalModal" data-backdrop="static" aria-label="<?= Yii::t('UserModule.base', 'Crop profile image'); ?>">
				<i class="fa fa-edit"></i></a>
			<?php
			echo \humhub\widgets\ModalConfirm::widget(array(
				'uniqueID' => 'modal_profileimagedelete',
				'linkOutput' => 'a',
				'ariaLabel' => Yii::t('UserModule.base', 'Delete profile image'),
				'title' => Yii::t('UserModule.widgets_views_deleteImage', '<strong>Confirm</strong> image deleting'),
				'message' => Yii::t('UserModule.widgets_views_deleteImage', 'Do you really want to delete your profile image?'),
				'buttonTrue' => Yii::t('UserModule.widgets_views_deleteImage', 'Delete'),
				'buttonFalse' => Yii::t('UserModule.widgets_views_deleteImage', 'Cancel'),
				'linkContent' => '<i class="fa fa-times"></i>',
				'cssClass' => 'btn btn-danger btn-sm',
				'style' => $user->getProfileImage()->hasImage() ? '' : 'display: none;',
				'linkHref' => Url::to(["/user/image/delete", 'type' => ImageController::TYPE_PROFILE_IMAGE, 'userGuid' => $user->guid]),
				'confirmJS' => 'function(jsonResp) { resetProfileImage(jsonResp); }'
			));
			?>
		</div>
	<?php endif; ?>

</div>



<!-- start: Error modal -->
<div class="modal" id="uploadErrorModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
	<div class="modal-dialog modal-dialog-extra-small animated pulse">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title"
				    id="myModalLabel"><?php echo Yii::t('UserModule.widgets_views_profileHeader', '<strong>Something</strong> went wrong'); ?></h4>
			</div>
			<div class="modal-body text-center">

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary"
				        data-dismiss="modal"><?php echo Yii::t('UserModule.widgets_views_profileHeader', 'Ok'); ?></button>
			</div>
		</div>
	</div>
</div>
