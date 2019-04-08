


<div class="article-post">
    <div class="img-block">
        <a href="<?= $blog->user->createUrl('/user/profile/blog-one', ['id' => $blog->id]); ?>">
	    <?= \humhub\modules\file\widgets\ShowPhotoPreview::widget(['object' => $blog]); ?>
        </a>
    </div>
    <div class="description-block">
        <div class="title">
            <a href="<?= $blog->user->createUrl('/user/profile/blog-one', ['id' => $blog->id]); ?>">
            <?= $blog->title; ?>
            </a>
        </div>
        <div class="subtitle"><?= isset($category[$blog->category])?$category[$blog->category]:''; ?></div>
        <div class="text">
            <div data-ui-widget="blog.Blog" data-state="collapsed" data-ui-init id="blog-content-<?= $blog->id; ?>" style="overflow: hidden; margin-bottom: 5px;">
                <div data-ui-markdown data-ui-show-more style="overflow: hidden;">
			        <?= humhub\widgets\RichText::widget(['text' => $blog->message, 'record' => $blog, 'markdown' => true]) ?>
                </div>
            </div>
        </div>
    </div>
</div>