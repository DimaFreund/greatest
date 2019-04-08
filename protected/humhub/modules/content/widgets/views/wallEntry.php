<?php

use humhub\libs\Html;
use humhub\modules\like\widgets\LikeLink;
use humhub\widgets\TimeAgo;
use humhub\modules\space\models\Space;
use humhub\modules\user\widgets\Image as UserImage;
use humhub\modules\content\widgets\WallEntryControls;
use humhub\modules\space\widgets\Image as SpaceImage;
use humhub\modules\content\widgets\WallEntryAddons;
use humhub\modules\content\widgets\WallEntryLabels;

/* @var $object \humhub\modules\content\components\ContentContainerActiveRecord */
/* @var $renderControls boolean */
/* @var $wallEntryWidget string */
/* @var $user \humhub\modules\user\models\User */
/* @var $showContentContainer \humhub\modules\user\models\User */
?>



<div class=" wall_<?= $object->getUniqueId(); ?>">
    <div class="panel-body">

        <div class="media base-post">


            <!-- since v1.2 -->
            <div class="stream-entry-loader"></div>

            <?php if($showHeader) { ?>
                <div class="header">
                <div class="user-img">
	                <?=
	                UserImage::widget([
		                'user' => $user,
		                'width' => false,
	                ]);
	                ?>
                </div>
                <div style="padding-right: 40px;" class="pull-right <?= ($renderControls) ? 'labels' : ''?>">
		            <?= WallEntryLabels::widget(['object' => $object]); ?>
                </div>
                <div class="wrap">
                    <div class="name"><?= Html::containerLink($user); ?></div>
	                <?php if ($showContentContainer): ?>
                        <span class="viaLink">
                            <i class="fa fa-caret-right" aria-hidden="true"></i>
			                <?= Html::containerLink($container); ?>
                        </span>
	                <?php endif; ?>
                    <div class="title"><?= $userAction; ?></div>
                    <div class="type"><?= $actionName; ?></div>
                    <div class="date"><?= TimeAgo::widget(['timestamp' => $createdAt]); ?>
	                    <?php if ($updatedAt !== null) : ?>
                            &middot;
                            <span class="tt" title="<?= Yii::$app->formatter->asDateTime($updatedAt); ?>"><?= Yii::t('ContentModule.base', 'Updated'); ?></span>
	                    <?php endif; ?>
                    </div>


                </div>

            </div>
            <?php } ?>


            <?php if ($showContentContainer && $container instanceof Space): ?>
                <?=
                SpaceImage::widget([
                    'space' => $container,
                    'width' => 20,
                    'htmlOptions' => ['class' => 'img-space'],
                    'link' => 'true',
                    'linkOptions' => ['class' => 'pull-left'],
                ]);
                ?>
            <?php endif; ?>

            <div class="content" id="wall_content_<?= $object->getUniqueId(); ?>">
                <?= $content; ?>
            </div>

            <!-- wall-entry-addons class required since 1.2 -->
            <?php if($renderAddons) : ?>

                <div class="footer">
                        <?= \humhub\modules\content\widgets\BottomPanelContent::widget(['object' => $object]); ?>
                </div>
	            <?= \humhub\modules\comment\widgets\Comments::widget(['object' => $object]); ?>

            <?php endif; ?>





	        <?php if($renderControls) : ?>
                <ul class="nav nav-pills preferences">
                    <li class="dropdown ">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-label="<?= Yii::t('base', 'Toggle stream entry menu'); ?>" aria-haspopup="true">
                            <span></span><span></span><span></span>
                        </a>


                        <ul class="dropdown-menu pull-right">
					        <?= WallEntryControls::widget(['object' => $object, 'wallEntryWidget' => $wallEntryWidget]); ?>
                        </ul>
                    </li>
                </ul>
	        <?php endif; ?>


        </div>
    </div>
</div>
