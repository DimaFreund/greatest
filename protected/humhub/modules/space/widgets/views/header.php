<?php
/* @var $this \humhub\components\View */
/* @var $currentSpace \humhub\modules\space\models\Space */

use humhub\modules\content\widgets\BottomPanelContent;
use humhub\modules\favorite\widgets\FavoriteLink;
use humhub\modules\like\widgets\LikeLink;
use yii\helpers\Html;

if ($space->isAdmin()) {
    $this->registerJsFile('@web-static/resources/space/spaceHeaderImageUpload.js');
    $this->registerJsVar('profileImageUploaderUrl', $space->createUrl('/space/manage/image/upload'));
    $this->registerJsVar('profileHeaderUploaderUrl', $space->createUrl('/space/manage/image/banner-upload'));
}
?>
<div class="group-top-block">
    <div class="group-img">
	    <?php if ($space->profileImage->hasImage()) : ?>
            <!-- profile image output-->
            <a data-ui-gallery="spaceHeader" href="<?= $space->profileImage->getUrl('_org'); ?>">
			    <?php echo \humhub\modules\space\widgets\Image::widget(['space' => $space, 'width' => 370]); ?>
            </a>
	    <?php else : ?>
		    <?php echo \humhub\modules\space\widgets\Image::widget(['space' => $space, 'width' => 370]); ?>
	    <?php endif; ?>

        <!-- check if the current user is the profile owner and can change the images -->
        <div class="image-upload-container profile-user-photo-container" style="width: 140px; height: 140px;">
	    <?php if ($space->isAdmin()) : ?>
            <form class="fileupload" id="profilefileupload" action="" method="POST" enctype="multipart/form-data"
                  style="position: absolute; top: 0; left: 0; opacity: 0; height: 240px; width: 140px;">
                <input type="file" name="spacefiles[]">
            </form>

            <div class="image-upload-loader" id="profile-image-upload-loader" style="padding-top: 60px;">
                <div class="progress image-upload-progess-bar" id="profile-image-upload-bar">
                    <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="00"
                         aria-valuemin="0"
                         aria-valuemax="100" style="width: 0%;">
                    </div>
                </div>
            </div>

            <div class="image-upload-buttons" id="profile-image-upload-buttons">
                <a onclick="javascript:$('#profilefileupload input').click();" class="btn btn-info btn-sm"><i
                            class="fa fa-cloud-upload"></i></a>
                <a id="profile-image-upload-edit-button"
                   style="<?php
			       if (!$space->getProfileImage()->hasImage()) {
				       echo 'display: none;';
			       }
			       ?>"
                   href="<?php echo $space->createUrl('/space/manage/image/crop'); ?>"
                   class="btn btn-info btn-sm" data-target="#globalModal" data-backdrop="static"><i
                            class="fa fa-edit"></i></a>
			    <?php
			    echo humhub\widgets\ModalConfirm::widget(array(
				    'uniqueID' => 'modal_profileimagedelete',
				    'linkOutput' => 'a',
				    'title' => Yii::t('SpaceModule.widgets_views_deleteImage', '<strong>Confirm</strong> image deleting'),
				    'message' => Yii::t('SpaceModule.widgets_views_deleteImage', 'Do you really want to delete your profile image?'),
				    'buttonTrue' => Yii::t('SpaceModule.widgets_views_deleteImage', 'Delete'),
				    'buttonFalse' => Yii::t('SpaceModule.widgets_views_deleteImage', 'Cancel'),
				    'linkContent' => '<i class="fa fa-times"></i>',
				    'cssClass' => 'btn btn-danger btn-sm',
				    'style' => $space->getProfileImage()->hasImage() ? '' : 'display: none;',
				    'linkHref' => $space->createUrl("/space/manage/image/delete", array('type' => 'profile')),
				    'confirmJS' => 'function(jsonResp) { resetProfileImage(jsonResp); }'
			    ));
			    ?>
            </div>
	    <?php endif; ?>
        </div>
    </div>
    <div class="short-info">
        <div class="name"><?php echo Html::encode($space->name); ?></div>
        <div class="category"><?= isset($category[$space->category])?$category[$space->category]:''; ?></div>
        <div class="desc"><?php echo Html::encode($space->description); ?></div>
        <div class="bottom">
            <ul class="group-menu">
	            <?=
	            humhub\modules\space\widgets\HeaderControls::widget(['widgets' => [
		            [\humhub\modules\space\widgets\InviteButton::className(), ['space' => $space], ['sortOrder' => 10]],
		            [\humhub\modules\space\widgets\MembershipButton::className(), ['space' => $space], ['sortOrder' => 20]],
	            ]]);
	            ?>

                <li class="share">
                    <div class="link">
	                    <?= LikeLink::widget(['object' => $space, 'mode' => BottomPanelContent::SMALL_MODE]); ?>
                        <style> .link .likeCount { display: none!important; }</style>
                        <div class="tooltip-base"><?= Yii::t( 'LikeModule.widgets_views_likeLink', 'Like' ) ?></div>
                    </div>
                </li>
                <li class="follow">
                    <div class="link">
	                    <?= FavoriteLink::widget(['object' => $space, 'mode' => BottomPanelContent::SMALL_MODE]); ?>
                    </div>
                </li>
	            <?=
	            humhub\modules\space\widgets\HeaderControlsMenu::widget([
		            'space' => $space,
		            'template' => '@humhub/widgets/views/dropdownNavigation'
	            ]);
	            ?>
            </ul>
            <div class="statistic-info">
                <div class="subscribers"><svg class="icon icon-members"><use xlink:href="./svg/sprite/sprite.svg#members"></use></svg>
                    <div class="val">
                        <a href="<?= $space->createUrl('/space/membership/members-list'); ?>">
                            <?= $space->getMemberships()->count(); ?>
                        </a>
                    </div>
                </div>
                <div class="thumbUp"><svg class="icon icon-liked"><use xlink:href="./svg/sprite/sprite.svg#liked"></use></svg>
                    <div class="val"><?= count($like); ?></div>
                </div>
                <div class="stars"><svg class="icon icon-star_fill"><use xlink:href="./svg/sprite/sprite.svg#star_fill"></use></svg>
                    <div class="val"><?= $favorite; ?></div>
                </div>
            </div>

	        <?php echo \humhub\modules\space\widgets\Menu::widget(['space' => $space]); ?>

        </div>
    </div>
</div>

<!-- start: Error modal -->
<div class="modal" id="uploadErrorModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-extra-small animated pulse">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"
                    id="myModalLabel"><?php echo Yii::t('SpaceModule.widgets_views_profileHeader', '<strong>Something</strong> went wrong'); ?></h4>
            </div>
            <div class="modal-body text-center">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary"
                        data-dismiss="modal"><?php echo Yii::t('SpaceModule.widgets_views_profileHeader', 'Ok'); ?></button>
            </div>
        </div>
    </div>
</div>
