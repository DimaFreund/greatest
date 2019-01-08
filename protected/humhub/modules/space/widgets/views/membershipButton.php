<?php

use humhub\modules\space\models\Space;
use humhub\modules\space\models\Membership;
use yii\helpers\Html;

if ($membership === null) {
    if ($space->canJoin()) {
        if ($space->join_policy == Space::JOIN_POLICY_APPLICATION) { ?>
            <li>
                <a href="<?= $space->createUrl('/space/membership/request-membership-form'); ?>" data-target="#globalModal">
                <div class="link">
                    <svg class="icon icon-friend">
                        <use xlink:href="./svg/sprite/sprite.svg#friend"></use>
                    </svg>
                    <div class="tooltip-base"><?= Yii::t('SpaceModule.widgets_views_membershipButton', 'Request membership'); ?></div>
                </div>
                </a>
            </li>

        <?php } else { ?>
            <li>
                <a href="<?= $space->createUrl('/space/membership/request-membership'); ?>" data-method="POST">
                    <div class="link">
                        <svg class="icon icon-friend">
                            <use xlink:href="./svg/sprite/sprite.svg#friend"></use>
                        </svg>
                        <div class="tooltip-base"><?= Yii::t('SpaceModule.widgets_views_membershipButton', 'Become member'); ?></div>
                    </div>
                </a>
            </li>
        <?php }
    }
} elseif ($membership->status == Membership::STATUS_INVITED) {
    ?>
    <div class="btn-group">
        <li><?php echo Html::a(Yii::t('SpaceModule.widgets_views_membershipButton', 'Accept Invite'), $space->createUrl('/space/membership/invite-accept'), array('class' => 'btn btn-info', 'data-method' => 'POST')); ?></li>
        <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="caret"></span>
            <span class="sr-only">Toggle Dropdown</span>
        </button>
        <ul class="dropdown-menu">
            <li><?php echo Html::a(Yii::t('SpaceModule.widgets_views_membershipButton', 'Deny Invite'), $space->createUrl('/space/membership/revoke-membership'), array('data-method' => 'POST')); ?></li>
        </ul>
    </div>
    <?php
} elseif ($membership->status == Membership::STATUS_APPLICANT) { ?>

    <li>
        <a href="<?= $space->createUrl('/space/membership/revoke-membership'); ?>" data-method="POST">
            <div class="link">
                <svg class="icon icon-friend">
                    <use xlink:href="./svg/sprite/sprite.svg#unfriend"></use>
                </svg>
                <div class="tooltip-base"><?= Yii::t('SpaceModule.widgets_views_membershipButton', 'Cancel pending membership application'); ?></div>
            </div>
        </a>
    </li>
<?php }