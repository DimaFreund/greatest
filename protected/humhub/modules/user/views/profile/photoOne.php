<?php
/**
 * Created by PhpStorm.
 * User: work
 * Date: 21.06.18
 * Time: 17:03
 */

use yii\helpers\Url;

?>
<div class="content-wrap">
	<div class="personal-profile-photo-single comments-node">
		<div class="photo-top">
			<div class="title"><?= $photo->title; ?></div>
            <a href="<?= $this->context->contentContainer->createUrl('/user/profile/photos', ['id' => $album->id]); ?>"><div class="album-name"><?= $album->title; ?></div></a>
			<div class="date"><?= \humhub\widgets\TimeAgo::widget(['timestamp' => $photo->date_create]); ?></div>
		</div>
		<div class="photo"><img src="<?= $photoUrl; ?>">
			<div class="photo-controls">
				<?php if($urlPrev) { ?>
                    <a class="prev" href="<?= $urlPrev; ?>"></a>
				<?php } ?>
                <?php if($urlNext) { ?>
                    <a class="next" href="<?= $urlNext; ?>"></a>
                <?php } ?>
            </div>
			<div class="sub-context-menu">
				<div class="context-menu-btn"><span></span><span></span><span></span></div>
				<ul class="context-menu">
					<li><a href="#">Edit</a></li>
					<li><a href="#">Edit 2</a></li>
					<li><a href="#">Edit 3</a></li>
				</ul>
			</div>
		</div>
		<div class="footer">
			<?= \humhub\modules\content\widgets\BottomPanelContent::widget(['object' => $photo]); ?>
        </div>
		<?= \humhub\modules\comment\widgets\Comments::widget(['object' => $photo]); ?>
	</div>
</div>
<div class="base-btn"><a href="<?= $this->context->contentContainer->createUrl('/user/profile/photo-albums'); ?>">All Albums</a></div>
