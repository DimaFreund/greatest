<?php
/**
 * Created by PhpStorm.
 * User: work
 * Date: 13.03.18
 * Time: 13:24
 */

use humhub\modules\comment\widgets\Comments;
?>

<div class="page-content">
    <div class="content-wrap">
        <div class="polls-page">
            <div class="polls-page-header">
                <div class="title"><?= Yii::t('base','News'); ?></div>
                <div class="stat"><?= $count; ?> <?= Yii::t('base','News'); ?></div></div>
			<?php



			echo \humhub\modules\stream\widgets\StreamViewer::widget(array(
				'streamAction' => '/news/news/streamPublic',
				'messageStreamEmpty' =>
					Yii::t('PollsModule.widgets_views_stream', '<b>There are no news yet!</b><br>Be the first and create one...'),
				'messageStreamEmptyCss' => 'placeholder-empty-stream',
				'filters' => [
					'filter_visibility_public' => Yii::t('base', 'Only public news'),
					'filter_visibility_private' => Yii::t('base', 'Only private news')
				]
			));
			?>

        </div>
    </div>
    <!--	<div class="base-btn"><a href="#">Load more</a></div>-->
</div>
