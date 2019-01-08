<?php
/**
 * Created by PhpStorm.
 * User: work
 * Date: 23.06.18
 * Time: 12:28
 */
?>
<div class="page-content">
	<div class="content-wrap">
		<div class="polls-page">
			<div class="polls-page-header">
				<div class="title">Polls</div>
				<div class="stat"><?= $count; ?> polls</div></div>
			<?php



			echo \humhub\modules\stream\widgets\StreamViewer::widget(array(
				'streamAction' => '/polls/list/streamPublic',
				'messageStreamEmpty' =>
					Yii::t('PollsModule.widgets_views_stream', '<b>There are no polls yet!</b><br>Be the first and create one...'),
				'messageStreamEmptyCss' => 'placeholder-empty-stream',
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
<!--	<div class="base-btn"><a href="#">Load more</a></div>-->
</div>
