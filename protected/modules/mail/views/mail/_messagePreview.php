<?php

/**
 * Shows a  preview of given $userMessage (UserMessage).
 * 
 * This can be the notification list or the message navigation
 */
use yii\helpers\Html;
use humhub\widgets\TimeAgo;
use humhub\libs\Helpers;
use humhub\widgets\MarkdownView;
$message = $userMessage->message;
?>

<?php if ($message->getLastEntry() != null) : ?>

	<?php
	// show the new badge, if this message is still unread
    $unread = false;
	if ($message->updated_at > $userMessage->last_viewed && $message->getLastEntry()->user->id != Yii::$app->user->id) {
		$unread = true;
	}
	?>
    <li class="dialog messagePreviewEntry_<?php echo $message->id; ?> <?php if($unread) echo 'hasNew'; ?>">
        <a href="javascript:loadMessage('<?php echo $message->id; ?>');">
            <div class="photo">
	            <?php if(count($message->anotherUsers) > 1) { ?>
                    <div class="count-users">
                        <span><?= count($message->anotherUsers); ?></span>
                        Users
                    </div>
	            <?php } else { ?>
                    <img data-src="holder.js/32x32" alt="32x32" src="<?php echo $message->anotherUsers[0]->getProfileImage()->getUrl(); ?>">
	            <?php } ?>
            </div>
            <div class="dialog-wrap">
                <div class="name">
                <?php foreach($message->anotherUsers as $user) { ?>
                    <span>
                    <?php echo Html::encode($user->displayName); ?>
                    </span>
                <?php } ?>
                </div>
                <div class="shortMsg"><?php echo $message->getLastEntry()->user->displayName.': '.\humhub\widgets\EmojiConvertToImage::widget(['content' => Helpers::truncateText(MarkdownView::widget(['markdown' => $message->getLastEntry()->content, 'parserClass' => '\humhub\libs\MarkdownPreview', 'returnPlain' => true]), 30)]); ?></div>
                <div class="date"><?php echo TimeAgo::widget(['timestamp' => $message->updated_at]); ?></div>
                <?php if($unread) { ?>
                <div class="dialog-couter"><span><?= Yii::t('MailModule.views_mail_index', 'New'); ?></span></div>
                <?php } ?>
            </div>
        </a>
    </li>

<?php endif; ?>
