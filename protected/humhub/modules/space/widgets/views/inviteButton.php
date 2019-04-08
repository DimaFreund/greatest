
<li>
    <a data-action-click="ui.modal.load" data-action-url="<?= $space->createUrl( '/space/membership/invite' ) ?>">
        <div class="link">
            <svg class="icon icon-message">
                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="./svg/sprite/sprite.svg#message"></use>
            </svg>
            <div class="tooltip-base"><?= Yii::t( 'SpaceModule.widgets_views_inviteButton', 'Invite' ) ?></div>
        </div>
    </a>
</li>