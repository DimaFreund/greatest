<?php
use yii\helpers\Url;
?>

<a href="<?= Url::toRoute(['/news/news/view', 'id' => $news->id]); ?>" class="article-post">
    <div class="img-block">
		<?= \humhub\modules\file\widgets\ShowPhotoPreview::widget( [ 'object' => $news ] ); ?>
    </div>
    <div class="description-block">
        <div class="date"><?= \humhub\widgets\TimeAgo::widget( [ 'timestamp' => $news->created_at ] ); ?></div>
        <div class="title"><?= $news->title; ?></div>
        <div class="subtitle"><?= isset( $category[ $news->category ] ) ? $category[ $news->category ] : ''; ?></div>
        <div class="text">
            <div data-ui-markdown data-ui-show-more style="overflow: hidden;">
				<?= humhub\widgets\RichText::widget( [ 'text'     => $news->message,
				                                       'record'   => $news,
				                                       'markdown' => true
				] ) ?>
            </div>
        </div>
    </div>
</a>