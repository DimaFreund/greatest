<?php 

use yii\helpers\Url;

$this->registerJsConfig('notification', [
    'icon' => $this->theme->getBaseUrl().'/ico/notification-o.png',
    'loadEntriesUrl' => Url::to(['/notification/list']),
    'sendDesktopNotifications' => boolval(Yii::$app->notification->getDesktopNoficationSettings(Yii::$app->user->getIdentity())),
    'text' =>  [
        'placeholder' => Yii::t('NotificationModule.widgets_views_list', 'There are no notifications yet.')
    ]
]);
?>


<div class="item item-notification" data-ui-widget="notification.NotificationDropDown" data-ui-init='<?= \yii\helpers\Json::encode($update); ?>'>
    <a class="mobile-link" href="<?= Url::to(['/notification/overview']); ?>"></a>
    <div class="activity-icon" data-action-click='toggle'>
        <svg class="icon icon-notifications" id="icon-notifications">
            <use xlink:href="svg/sprite/sprite.svg#notifications"></use>
        </svg>
        <div id="badge-notifications" class="activity-counter" style="display: flex;"><span></span></div>
    </div>
    <div class="tooltip-base">Notifications</div>
    <div class="activity-sub-menu">
        <div class="notifications-sub-menu">
            <div class="sub-menu-header">
                <div class="title">Notifications</div>
                <div class="counter"><span><span></span> New</span></div>
            </div>
            <div class="sub-menu-content">
                <div class="newList">
                    <div class="list-header"><span>New</span></div>
                    <ul id="dropdown-notifications">
                        <ul class="media-list"></ul>
                        <li id="loader_notifications">
							<?= \humhub\widgets\LoaderWidget::widget(); ?>
                        </li>

                    </ul>
                </div>
                                <div class="earlierList">
                                    <div class="list-header"><span>Earlier</span></div>
                                    <ul class="media-list-old"></ul>
                                </div>
            </div>
            <div class="sub-menu-footer">
                <a href="#" class="markAsRead" id="mark-seen-link" data-action-click='markAsSeen' data-action-url="<?= Url::to(['/notification/list/mark-as-seen']); ?>">
		            <?= Yii::t('NotificationModule.widgets_views_list', 'Mark all as seen'); ?>
                </a>
                <a class="seeAll" href="<?= Url::to(['/notification/overview']); ?>">See all</a></div>
        </div>
    </div>
</div>