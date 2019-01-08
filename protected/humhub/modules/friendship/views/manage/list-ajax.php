<?php
/**
 * Created by PhpStorm.
 * User: work
 * Date: 08.06.18
 * Time: 14:04
 */

use humhub\modules\content\widgets\BottomPanelContent;
use humhub\modules\desire\models\Desire;

?>

<?php foreach($friends as $friend) { ?>
	<li class="friend">
		<div class="photo"><a href="<?= $friend->createUrl('/user/profile/home'); ?>"><img src="<?= $friend->getProfileImage()->getUrl(); ?>"></a><span class="<?php if($friend->status_online === 1) echo 'active'; ?>"></span></div>
		<div class="user-wrap">
			<div class="name"><a href="<?= $friend->createUrl('/user/profile/home'); ?>"><?= $friend->username; ?></a></div>
			<?php $greatestDesire = Desire::getGreatestDesire($friend); ?>
            <?php if($greatestDesire) { ?>
			<a href="<?= $friend->createUrl('/user/profile/desire-one', ['id' => $greatestDesire->id]); ?>"><div class="user-desire"><?= $greatestDesire->title; ?></div></a>

            <div class="statistic-info">
				<?= BottomPanelContent::widget([
					'object' => $greatestDesire,
					'mode' => BottomPanelContent::SMALL_MODE,
					'ratingLink' => true,
					'commentLinkPage' => true,
					'options' => ['commentPageUrl' => '/user/profile/desire-one'],
				]); ?>
			</div>
            <?php } ?>
		</div>
		<ul class="menu">
			<?= \humhub\modules\user\widgets\UserButtons::widget(['user' => $friend, 'displayControl' => true]); ?>
		</ul>
	</li>
<?php } ?>
