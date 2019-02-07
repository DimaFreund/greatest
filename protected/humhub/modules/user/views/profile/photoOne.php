<?php
/**
 * Created by PhpStorm.
 * User: work
 * Date: 21.06.18
 * Time: 17:03
 */

use yii\helpers\Html;
use yii\helpers\Url;

?>
<div class="content-wrap">
	<div class="personal-profile-photo-single comments-node">
		<div class="photo-top">
			<div class="title">Photo from <?= $this->context->contentContainer->username; ?></div>
            <a href="<?= $this->context->contentContainer->createUrl('/user/profile/photos', ['id' => $album->id]); ?>"><div class="album-name"><?= $album->title; ?></div></a>
			<div class="date"><?= \humhub\widgets\TimeAgo::widget(['timestamp' => $photo->date_create]); ?></div>
		</div>
		<div class="photo">

            <?php foreach ($album->getMediaList() as $photo) { ?>
                <a href="<?= $photo->getFileUrl() ?>#.jpeg"
		            <?php if ($uiGalleryId): ?>
                        data-type="image"
                        data-toggle="lightbox"
                        data-parent="#gallery-content"
                        data-description="<?= Html::encode($photo->description) ?>"
                        title="<?= Html::encode($photo->description) ?>"
                        data-ui-gallery="<?= $uiGalleryId ?>"
		            <?php endif; ?>>
                    <?php if($photoId === $photo->id) { ?>
                        <img src="<?= $photoUrl; ?>">
                    <?php } ?>
                </a>
            <?php } ?>

			<div class="photo-controls">
				<?php if($urlPrev) { ?>
                    <a class="prev" href="<?= $urlPrev; ?>"></a>
				<?php } ?>
                <?php if($urlNext) { ?>
                    <a class="next" href="<?= $urlNext; ?>"></a>
                <?php } ?>
            </div>
<!--			<div class="sub-context-menu">-->
<!--				<div class="context-menu-btn"><span></span><span></span><span></span></div>-->
<!--				<ul class="context-menu">-->
<!--					<li><a href="#">Edit</a></li>-->
<!--					<li><a href="#">Edit 2</a></li>-->
<!--					<li><a href="#">Edit 3</a></li>-->
<!--				</ul>-->
<!--			</div>-->
		</div>
		<div class="footer">
			<?= \humhub\modules\content\widgets\BottomPanelContent::widget(['object' => $photo]); ?>
        </div>
		<?= \humhub\modules\comment\widgets\Comments::widget(['object' => $photo]); ?>
	</div>
</div>
<div class="base-btn"><a href="<?= $this->context->contentContainer->createUrl('/gallery/list'); ?>">All Albums</a></div>
