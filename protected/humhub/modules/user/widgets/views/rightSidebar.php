<?php
use humhub\modules\content\models\Category;
use humhub\modules\content\widgets\BottomPanelContent;
use humhub\modules\content\widgets\CategoryFilter;
use humhub\modules\desire\models\Desire;
use humhub\modules\file\widgets\ShowPhotoPreview;
use humhub\modules\polls\widgets\PollsItem;
use yii\helpers\Html;
use yii\helpers\Url;
?>




<aside class="right-side">
	<div class="right-sidebar">
        <?php $currentModule = Yii::$app->controller->module->id; ?>
        <?php $controllerID = Yii::$app->controller->id; ?>
        <?php if(in_array($currentModule, Category::$object)) { ?>
            <?php if(!($currentModule === 'space' &&  $controllerID != 'list') && !($currentModule === 'gallery' && $controllerID != 'gallery') && !($currentModule === 'blog' && Yii::$app->controller->action->id != 'index')) { ?>
		<?= CategoryFilter::widget(['model' => $currentModule]); ?>
        <?php }  } ?>
		<div class="item" id="sidebar-info">
			<div class="item-header">
				<div class="label"><?= Yii::t('base', 'Info'); ?>
					<div class="marker"></div>
				</div>
			</div>
			<div class="item-content ">
				<div class="content-wrap">
                    <?php
                    if(isset($userInfo->gender)) { ?>
					<div class="gender">
						<div class="label"><?= Yii::t('base', 'Gender'); ?></div>
						<div class="text"><?= $userInfo->gender; ?></div>
					</div>
                    <?php } ?>
                    <?php if(isset($userInfo->city)) { ?>
					<div class="place">
						<div class="label"><?= Yii::t('base', 'From'); ?></div>
						<div class="text">
							<svg class="icon icon-location">
								<use xlink:href="./svg/sprite/sprite.svg#location"></use>
							</svg>
							<?= $userInfo->city; ?>
						</div>
					</div>
                    <?php } ?>
                    <?php if(isset($userInfo->age)) { ?>
					<div class="age">
						<div class="label"><?= Yii::t('base', 'Age'); ?></div>
						<div class="text"><?= $userInfo->age; ?></div>
					</div>
                    <?php } ?>
				</div>
				<div class="moreItem"><a href="<?= $user->createUrl('/user/profile/about'); ?>"><?= Yii::t('base', 'Read more'); ?></a></div>
			</div>
		</div>
		<div class="item sidebar-friends-layout" id="sidebar-friends">
			<div class="item-header">
				<div class="label"><?= Yii::t('base', 'Friends'); ?>
					<div class="marker"></div>
				</div>
			</div>
			<div class="item-content ">
				<ul>
                    <?php foreach($friends as $friend) { ?>
					    <li class="friend">
						<a href="<?= $friend->createUrl('/user/profile/home'); ?>">
							<div class="photo"><img src="<?= $friend->getProfileImage()->getUrl(); ?>"><span class="<?php if($friend->status_online === 1) echo 'active'; ?>"></span></div>
							<div class="user-wrap">
								<div class="name"><?= $friend->username; ?></div>
								<?php $greatestDesire = Desire::getGreatestDesire($friend); ?>
								<div class="user-desire"><?= $greatestDesire->title; ?></div>
							</div>
						</a>
						<div class="statistic-info">
							<?= BottomPanelContent::widget([
								'object' => $greatestDesire,
								'mode' => BottomPanelContent::SMALL_MODE,
								'ratingLink' => true,
								'commentLinkPage' => true,
								'options' => ['commentPageUrl' => '/user/profile/desire-one'],
							]); ?>
						</div>
					</li>
                    <?php } ?>
				</ul>
				<div class="moreItem"><a href="<?= $user->createUrl('/friendship/manage/list', ['id' => $user->id]); ?>"><?= Yii::t('base', 'View all'); ?></a></div>
			</div>
		</div>
		<div class="item sidebar-blog-layout" id="sidebar-blog-post">
			<div class="item-header">
				<div class="label"><?= Yii::t('base', 'Latest blog posts'); ?>
					<div class="marker"></div>
				</div>
			</div>
			<div class="item-content ">
				<ul>
					<?php foreach($blogs as $blog) { ?>
					<li class="post">
						<a href="<?= $user->createUrl('/user/profile/blog-one', ['id' => $blog->id]); ?>">
							<div class="photo">
                                <?= ShowPhotoPreview::widget(['object' => $blog, 'options' => ['index' => 0]]); ?>
                            </div>
							<div class="post-wrap">
								<div class="title"><?= $blog->title; ?></div>
								<div class="text"><?= $blog->message; ?>
								</div>
							</div>
						</a>
						<div class="statistic-info">
							<?= BottomPanelContent::widget([
								'object' => $blog,
								'mode' => BottomPanelContent::SMALL_MODE,
								'commentLinkPage' => true,
								'options' => ['commentPageUrl' => '/user/profile/blog-one'],
							]); ?>
						</div>
					</li>
                    <?php } ?>
				</ul>
				<div class="moreItem"><a href="<?= $user->createUrl('/user/profile/blog'); ?>"><?= Yii::t('base', 'Read all'); ?></a></div>
			</div>
		</div>
		<div class="item" id="sidebar-latest-photos">
			<div class="item-header">
				<div class="label"><?= Yii::t('base', 'Latest photos'); ?>
					<div class="marker"></div>
				</div>
			</div>
			<div class="item-content ">
				<ul>
                    <?php foreach($media as $item) { ?>
					    <li class="photo"><a href="<?= $user->createUrl('/user/profile/photo-one', ['id' => $item->id]) ?>"><img src="<?= $item->getSquarePreviewImageUrl(); ?>"></a></li>
					<?php } ?>
				</ul>
				<div class="moreItem"><a href="<?= $user->createUrl('/user/profile/photo-albums'); ?>"><?= Yii::t('base', 'View all'); ?></a></div>
			</div>
		</div>
		<div class="item" id="sidebar-groups">
			<div class="item-header">
				<div class="label"><?= Yii::t('base', 'Groups'); ?>
					<div class="marker"></div>
				</div>
			</div>
			<div class="item-content ">
				<ul>
					<?php foreach($spaces as $space) { ?>
					<li class="group">
						<a href="<?= $space->getUrl(); ?>">
							<div class="photo"><img src="<?php echo $space->getProfileImage()->getUrl(); ?>"></div>
							<div class="group-wrap">
								<div class="title"><?php echo Html::encode($space->name); ?></div>

								<div class="text"><?= \humhub\widgets\RichText::widget(['text' => $space->description, 'maxLength' => 70]); ?></div>
							</div>
						</a>
						<div class="statistic-info">
                            <div class="subscribers"><svg class="icon icon-members"><use xlink:href="./svg/sprite/sprite.svg#members"></use></svg>
                                <div class="val"><?= $space->getMemberships()->count(); ?></div>
                            </div>
							<?= \humhub\modules\like\widgets\LikeLink::widget(['object' => $space, 'mode' => true]); ?>
							<?= \humhub\modules\favorite\widgets\FavoriteLink::widget(['object' => $space, 'mode' => true]); ?>
						</div>
					</li>
                    <?php } ?>
				</ul>
				<div class="moreItem"><a href="<?= $user->createUrl('/user/profile/space-membership-list'); ?>"><?= Yii::t('base', 'View all'); ?></a></div>
			</div>
		</div>
		<div class="item" id="sidebar-polls">
			<div class="item-header">
				<div class="label"><?= Yii::t('base', 'Polls'); ?>
					<div class="marker"></div>
				</div>
			</div>
			<div class="item-content ">
                <?php foreach ($polls as $poll) { ?>
                <div onclick="window.location = '<?= Url::to(['/content/perma', 'id' => $poll->content->id]); ?>'" class="pool-sidebar-wraper">
					<?= PollsItem::widget(['poll' => $poll]); ?>
					<div class="statistic-info">
						<?= BottomPanelContent::widget([
							'object' => $poll,
							'mode' => BottomPanelContent::SMALL_MODE,
							'commentLinkPage' => true,
							'options' => ['commentPageUrl' => '/content/perma?id='.$poll->content->id],
						]); ?>
					</div>
                </div>
                <?php } ?>

				<div class="moreItem"><a href="<?= $user->createUrl('/user/profile/polls'); ?>"><?= Yii::t('base', 'View all'); ?></a></div>
			</div>
		</div>
        <div class="sidebar-footer">
            <div class="footer-item"><a href="<?= Url::toRoute('/'); ?>"><svg class="icon icon-members"><use xlink:href="./svg/sprite/sprite.svg#members"></use></svg><?= $statistic['members']; ?> <?= Yii::t('base', 'Members'); ?></a></div>
            <div class="footer-item"><a href="<?= Url::toRoute('/blog/blog'); ?>"><svg class="icon icon-blogs"><use xlink:href="./svg/sprite/sprite.svg#blogs"></use></svg><?= $statistic['blogs']; ?> <?= Yii::t('base', 'Blogs'); ?></a></div>
            <div class="footer-item"><a href="<?= Url::toRoute('/polls/list'); ?>"><svg class="icon icon-polls"><use xlink:href="./svg/sprite/sprite.svg#polls"></use></svg><?= $statistic['polls']; ?> <?= Yii::t('base', 'Polls'); ?></a></div>
            <div class="footer-item"><a href="<?= Url::toRoute('/news/news'); ?>"><svg class="icon icon-news"><use xlink:href="./svg/sprite/sprite.svg#news"></use></svg><?= $statistic['news']; ?> <?= Yii::t('base', 'News'); ?></a></div>
            <div class="footer-item"><a href="<?= Url::toRoute('/space/list'); ?>"><svg class="icon icon-groups"><use xlink:href="./svg/sprite/sprite.svg#groups"></use></svg><?= $statistic['groups']; ?> <?= Yii::t('base', 'Groups'); ?></a></div>
            <div class="footer-item"><a href="<?= Url::toRoute('/gallery/gallery'); ?>"><svg class="icon icon-photos"><use xlink:href="./svg/sprite/sprite.svg#photos"></use></svg><?= $statistic['photos']; ?> <?= Yii::t('base', 'Photos'); ?></a></div>
        </div>
	</div>
</aside>


