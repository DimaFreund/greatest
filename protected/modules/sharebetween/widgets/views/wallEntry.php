<?php

use humhub\modules\comment\widgets\CommentLink;
use humhub\modules\comment\widgets\Comments;
use humhub\modules\like\widgets\LikeLink;
use yii\helpers\Html;
use humhub\modules\space\models\Space;
use humhub\modules\content\components\ContentContainerController;

$user = $object->content->user;
$container = $object->content->container;
$sharedContent = $object->sharedContent->getPolymorphicRelation();
?>

<div class="panel panel-default wall_<?php echo $object->getUniqueId(); ?>">
    <div class="panel-body">
        <div class="media">
            <ul class="nav nav-pills preferences">
                <li class="dropdown ">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-angle-down"></i></a>
                    <ul class="dropdown-menu pull-right">
                        <?php echo \humhub\modules\content\widgets\WallEntryControls::widget(['object' => $object, 'wallEntryWidget' => $wallEntryWidget]); ?>

                    </ul>
                </li>
            </ul>

            <p>
                <?= Yii::t('SharebetweenModule.base', '{displayName} shared:', ['displayName' => Html::a($user->displayName, $user->getUrl())]); ?>
            </p>

            <div class="content" id="wall_content_<?php echo $object->getUniqueId(); ?>">
                <?php echo $content; ?>
            </div>

        </div>
        <div class="row">
            <div class="col-sm-12 social-activities-gallery colorFont5">
	            <?= CommentLink::widget(['object' => $object]); ?>
                |
			    <?= LikeLink::widget(['object' => $object]); ?>
            </div>
            <div class="col-sm-12 comments">
			    <?= Comments::widget(['object' => $object]); ?>
            </div>
        </div>
    </div>

</div>