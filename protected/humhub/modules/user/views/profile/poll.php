<?php
?>


	<div class="content-wrap">
		<div class="personal-profile-polls">
            <ul class="small-tabs-controls">
                <li class="<?= ($this->context->action->id === 'polls')? 'active': ''; ?>"><a href="<?= $this->context->contentContainer->createUrl('/user/profile/polls'); ?>"><?= Yii::t('base','Polls'); ?></a></li>
                <li><a class="<?= ($this->context->action->id === 'favorite-polls')? 'active': ''; ?>" href="<?= $this->context->contentContainer->createUrl('/user/profile/favorite-polls'); ?>"><?= Yii::t('base','Favorite'); ?> <?= Yii::t('base','polls'); ?></a></li>
            </ul>
<?php

$canCreatePolls = $contentContainer->permissionManager->can(new \humhub\modules\polls\permissions\CreatePoll());


echo \humhub\modules\stream\widgets\StreamViewer::widget(array(
	'contentContainer' => $contentContainer,
	'streamAction' => $streamUrl,
	'messageStreamEmpty' => ($canCreatePolls) ?
		Yii::t('PollsModule.widgets_views_stream', '<b>There are no polls yet!</b><br>Be the first and create one...') :
		Yii::t('PollsModule.widgets_views_stream', '<b>There are no polls yet!</b>'),
	'messageStreamEmptyCss' => ($canCreatePolls) ? 'placeholder-empty-stream' : '',
	'filters' => [
		'filter_polls_notAnswered' => Yii::t('PollsModule.widgets_views_stream', 'No answered yet'),
		'filter_entry_mine' => Yii::t('PollsModule.widgets_views_stream', 'Asked by me'),
		'filter_visibility_public' => Yii::t('PollsModule.widgets_views_stream', 'Only public polls'),
		'filter_visibility_private' => Yii::t('PollsModule.widgets_views_stream', 'Only private polls')
	]
));
?>

		</div>
	</div>