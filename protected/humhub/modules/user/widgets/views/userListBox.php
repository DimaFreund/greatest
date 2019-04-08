<?php

use humhub\modules\content\widgets\BottomPanelContent;
use humhub\modules\desire\models\Desire;

?>



<div class="content-wrap">
	<?php if (count($users) === 0): ?>
        <div class="modal-body">
            <p><?= Yii::t('UserModule.base', 'No users found.'); ?></p>
        </div>
	<?php endif; ?>
    <div class="personal-profile-friends">
        <ul id="list-object" class="friends-list">
			<?php foreach($users as $user) { ?>
                <li class="friend">
                    <div class="photo"><a href="<?= $user->createUrl('/user/profile/home'); ?>"><img src="<?= $user->getProfileImage()->getUrl(); ?>"></a><span class="<?php if($user->status_online === 1) echo 'active'; ?>"></span></div>
                    <div class="user-wrap">
                        <div class="name"><a href="<?= $user->createUrl('/user/profile/home'); ?>"><?= $user->username; ?></a></div>
						<?php $greatestDesire = Desire::getGreatestDesire($user); ?>
                        <?php if($greatestDesire) { ?>
                        <a href="<?= $user->createUrl('/user/profile/desire-one', ['id' => $greatestDesire->id]); ?>"><div class="user-desire"><?= $greatestDesire->title; ?></div></a>
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
						<?= \humhub\modules\user\widgets\UserButtons::widget(['user' => $user]); ?>
                    </ul>
                </li>
			<?php } ?>
        </ul>
        <div class="pagination-container">
		    <?= \humhub\widgets\LinkPager::widget(['pagination' => $pagination]); ?>
        </div>
    </div>
</div>