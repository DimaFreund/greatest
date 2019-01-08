<?php
/**
 * Created by PhpStorm.
 * User: work
 * Date: 04.06.18
 * Time: 14:30
 */

use yii\helpers\Url;

?>

<div class="content-wrap">
	<div class="personal-profile-blog">
        <ul class="small-tabs-controls">
			<li class="<?= ($this->context->action->id === 'blog')? 'active': ''; ?>"><a href="<?= $contentContainer->createUrl('/user/profile/blog'); ?>">Blog posts</a></li>
			<li class="<?= ($this->context->action->id === 'favorite-blog')? 'active': ''; ?>"><a href="<?= $contentContainer->createUrl('/user/profile/favorite-blog'); ?>">Favorite blog posts</a></li>
		</ul>
        <?= \humhub\modules\content\widgets\PageSortFilter::widget(['models' => $blogList]); ?>
		<div class="blog-post-list">
            <?php foreach($blogList as $blog) { ?>
			<div class="article-post">
				<a href="<?= $contentContainer->createUrl('/user/profile/blog-one', ['id' => $blog->id]); ?>" class="img-block">

                    <?= \humhub\modules\file\widgets\ShowPhotoPreview::widget(['object' => $blog]); ?>

				</a>
				<div class="description-block">
					<div class="date"><?= \humhub\widgets\TimeAgo::widget(['timestamp' => $blog->created_at]); ?></div>
					<a href="<?= $contentContainer->createUrl('/user/profile/blog-one', ['id' => $blog->id]); ?>" class="title"><?= $blog->title; ?></a>
					<div class="subtitle">
                    <?= isset($category[$blog->category])?$category[$blog->category]:''; ?>
                    </div>
					<div class="text"><?= $blog->message; ?></div>
				</div>

				<div class="footer">
					<?= \humhub\modules\content\widgets\BottomPanelContent::widget(['object' => $blog, 'commentLinkPage' => 1, 'options' => ['commentPageUrl' => '/user/profile/blog-one']]); ?>
                </div>
            </div>
            <?php } ?>
		</div>
	</div>
</div>
