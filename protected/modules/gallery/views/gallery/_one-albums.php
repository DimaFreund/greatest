<?php
/**
 * Created by PhpStorm.
 * User: work
 * Date: 25.06.18
 * Time: 15:52
 */

use humhub\modules\user\models\User;

?>
<?php foreach($albums as $album) { ?>
	<div class="album public-album">
		<?php $metaData = $album->getMetaData(); ?>
		<div class="img-block"><img src="<?= $metaData['thumbnailUrl']; ?>">
			<div class="category"><?= isset($category[$album->category])?$category[$album->category]:''; ?></div>
		</div>
		<div class="desc">
			<div class="author-block">
				<?php $user = User::findOne($album->content->created_by); ?>
				<div class="photo">
					<a href="<?= $user->createUrl('/user/profile/home'); ?>">
						<img src="<?= $user->getProfileImage()->getUrl(); ?>">
					</a>
				</div>
				<a href="<?= $user->createUrl('/user/profile/home'); ?>">
					<div class="name"><?= $user->username; ?></div>
				</a>
			</div><a class="title" href="<?= $user->createUrl('/user/profile/photos', ['id' => $album->id]); ?>"><?= $album->title; ?></a>
			<div class="img-counter"><?= count($album->getMediaList()); ?> photos</div>
			<div class="statistic-info">
				<?= \humhub\modules\content\widgets\BottomPanelContent::widget(['object' => $album, 'commentLinkPage' => true, 'options' => ['commentPageUrl' => '/user/profile/photos'], 'mode' => \humhub\modules\content\widgets\BottomPanelContent::SMALL_MODE]); ?>

			</div>
		</div>
	</div>
<?php } ?>
