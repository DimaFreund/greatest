<?php
use yii\helpers\Html;
?>
<?= Html::beginForm($contentContainer->createUrl('/polls/poll/answer', [ 'pollId' => $poll->id])); ?>
<?php if (!$poll->hasUserVoted() && !$poll->closed) { ?>

	<div class="polls-item checkbox-polls">
		<div class="title"><?= humhub\widgets\RichText::widget(['text' => $poll->question]); ?></div>
		<div class="radio-btn-wrap">
			<?php foreach ($poll->getViewAnswers() as $answer) : ?>
				<?= $this->render('_answer', ['poll' => $poll, 'answer' => $answer, 'contentContainer' => $contentContainer]); ?>
			<?php endforeach; ?>
		</div>
	</div>
<?php } else { ?>
	<div class="polls-item diagram-polls">
		<div class="title"><?= humhub\widgets\RichText::widget(['text' => $poll->question]); ?></div>
		<div class="diagram-wrap">
			<?php foreach ($poll->getViewAnswers() as $answer) : ?>
				<?= $this->render('_answer', ['poll' => $poll, 'answer' => $answer, 'contentContainer' => $contentContainer]); ?>
			<?php endforeach; ?>
		</div>
	</div>
<?php } ?>
<?php if($poll->allow_multiple && !$poll->hasUserVoted() && !$poll->closed) { ?>
	<div class="base-sm-btn reverse"><a data-action-click="vote" data-action-submit data-ui-loader href="#"><?= Yii::t('PollsModule.widgets_views_entry', 'Vote') ?></a></div>
<?php } ?>
<div class="clearFloats"></div>
<?php echo Html::endForm(); ?>
