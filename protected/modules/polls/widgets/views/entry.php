<?php

use humhub\modules\polls\widgets\PollsItem;
use yii\helpers\Html;

humhub\modules\polls\assets\PollsAsset::register($this);
?>
<div data-poll="<?= $poll->id ?>" data-content-component="polls.Poll" data-content-key="<?= $poll->content->id ?>" class="content">
	<?php if ($poll->closed) : ?>
        &nbsp;<span class="label label-danger pull-right"><?= Yii::t('PollsModule.widgets_views_entry', 'Closed') ?></span>
	<?php endif; ?>
	<?php if ($poll->anonymous) : ?>
        &nbsp;<span class="label label-success pull-right"><?= Yii::t('PollsModule.widgets_views_entry', 'Anonymous') ?></span>
	<?php endif; ?>
    <div class="polls-post">
	    <?= PollsItem::widget(['poll' => $poll]); ?>
    </div>
</div>
