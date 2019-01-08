<div class="post-wraper">
<div data-ui-widget="post.Post" data-state="collapsed" data-ui-init id="post-content-<?= $post->id; ?>" style="overflow: hidden; margin-bottom: 5px;">
    <div data-ui-show-more style="overflow: hidden;">
        <?= humhub\widgets\RichText::widget(['text' => $post->message, 'record' => $post, 'markdown' => false]) ?>
    </div>
</div>
</div>
<div class="post-photo-wraper">
<?= \humhub\modules\file\widgets\ShowPhotoPreview::widget(['object' => $post, 'options' => ['for' => 'post']]); ?>
</div>
