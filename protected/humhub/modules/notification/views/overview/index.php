<?php

use yii\widgets\ActiveForm;
use yii\helpers\Url;

?>
<div class="page-content">
    <div class="content-wrap">
        <div class="notifications-page panel"  data-ui-widget="notification.NotificationDropDown" data-ui-init='<?= \yii\helpers\Json::encode(\humhub\modules\notification\controllers\ListController::getUpdates()); ?>'>
            <div class="notifications-page-header panel-heading">
                <div class="title"><?= Yii::t('NotificationModule.views_overview_index', '<strong>Notification</strong> Overview'); ?>
                    <a id="notification_overview_markseen" href="#" data-action-click="markAsSeen" data-action-url="<?= Url::to(['/notification/list/mark-as-seen']); ?>" class="pull-right heading-link" >
                        <b><?= Yii::t('NotificationModule.views_overview_index', 'Mark all as seen'); ?></b>
                    </a>
                </div>
            </div>
            <ul class="notifications-list">
				<?php foreach ($notifications as $notification) : ?>
					<?= $notification->render(); ?>
				<?php endforeach; ?>
				<?php if (count($notifications) == 0) : ?>
					<?= Yii::t('NotificationModule.views_overview_index', 'No notifications found!'); ?>
				<?php endif; ?>
            </ul>
            <center>
				<?= ($pagination != null) ? \humhub\widgets\LinkPager::widget(['pagination' => $pagination]) : ''; ?>
            </center>
        </div>
    </div>
</div>
<aside class="right-side">
    <div class="right-sidebar">
        <div class="sidebar-categories">
            <div class="panel-heading">
                <strong><?= Yii::t('NotificationModule.views_overview_index', 'Filter'); ?></strong>
                <hr style="margin-bottom:0px"/>
            </div>

            <div class="panel-body">
				<?php $form = ActiveForm::begin(['id' => 'notification_overview_filter', 'method' => 'GET']); ?>
                <div style="padding-left: 5px;">
					<?= $form->field($filterForm, 'categoryFilter')->checkboxList($filterForm->getCategoryFilterSelection())->label(false); ?>
                </div>
                <button class="btn btn-primary btn-xm" type="submit" data-ui-loader><?= Yii::t('NotificationModule.views_overview_index', 'Apply'); ?></button>
				<?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</aside>
