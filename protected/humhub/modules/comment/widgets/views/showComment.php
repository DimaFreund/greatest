<?php

use humhub\libs\Html;
use humhub\widgets\TimeAgo;
use humhub\widgets\RichText;
use humhub\modules\user\widgets\Image as UserImage;
use humhub\modules\file\widgets\ShowFiles;
use humhub\modules\like\widgets\LikeLink;
?>





<div class="comment" id="comment_<?= $comment->id; ?>"
     data-action-component="comment.Comment"
     data-content-delete-url="<?= $deleteUrl ?>">

	<?php if ($canWrite || $canDelete) : ?>
        <div class="comment-entry-loader pull-right"></div>
        <ul class="nav nav-pills preferences">
            <li class="dropdown ">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-label="<?= Yii::t('base', 'Toggle comment menu'); ?>" aria-haspopup="true">
                    <span></span><span></span><span></span>
                </a>

                <ul class="dropdown-menu pull-right">
					<?php if ($canWrite): ?>
                        <li>
                            <a href="#" class="comment-edit-link" data-action-click="edit" data-action-url="<?= $editUrl ?>">
                                <i class="fa fa-pencil"></i> <?= Yii::t('CommentModule.widgets_views_showComment', 'Edit') ?>
                            </a>
                            <a href="#" class="comment-cancel-edit-link" data-action-click="cancelEdit" data-action-url="<?= $loadUrl ?>" style="display:none;">
                                <i class="fa fa-pencil"></i> <?= Yii::t('CommentModule.widgets_views_showComment', 'Cancel Edit') ?>
                            </a>
                        </li>
					<?php endif; ?>

					<?php if ($canDelete): ?>
                        <li>
                            <a href="#" data-action-click="delete">
                                <i class="fa fa-trash-o"></i>  <?= Yii::t('CommentModule.widgets_views_showComment', 'Delete') ?>
                            </a>
                        </li>
					<?php endif; ?>
                </ul>
            </li>
        </ul>
	<?php endif; ?>


	<?= UserImage::widget(['user' => $user, 'width' => 50, 'htmlOptions' => ['class' => 'author-img']]); ?>
	<?= Html::containerLink($user, ['class' => 'author-name']); ?>
    <div class="comment-text comment_edit_content" id="comment_editarea_<?= $comment->id; ?>">
        <div id="comment-message-<?= $comment->id; ?>" class="comment-message" data-ui-show-more data-read-more-text="<?= Yii::t('CommentModule.widgets_views_showComment', 'Read full comment...') ?>">

            <?= humhub\widgets\RichText::widget(['text' => $comment->message, 'record' => $comment, 'markdown' => true]) ?>
        </div>
	    <?= ShowFiles::widget(['object' => $comment]); ?>
    </div>
    <div class="comment-footer">
	    <?= LikeLink::widget(['object' => $comment]); ?>

        <div class="replay hidden">
            <div class="text">Replay</div>
            <div class="val">(<span>102</span>)</div>
        </div>
        <div class="date">
            <div class="val"><?= TimeAgo::widget(['timestamp' => $createdAt]); ?>
	            <?php if ($updatedAt !== null): ?>
                    &middot; <span class="tt" title="<?= Yii::$app->formatter->asDateTime($updatedAt); ?>"><?= Yii::t('ContentModule.base', 'Updated'); ?></span>
	            <?php endif; ?>
            </div>
        </div>
    </div>
</div>