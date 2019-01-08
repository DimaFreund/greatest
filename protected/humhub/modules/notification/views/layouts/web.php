<?php

/** @var \humhub\modules\user\models\User $originator */

use humhub\modules\friendship\models\Friendship;

/** @var \humhub\modules\space\models\Space $space */
/** @var \humhub\modules\notification\models\Notification $record */
/** @var boolean $isNew */
/** @var string $content */

?>

<li class="notification">
	<?php if ($originator !== null): ?>
    <div class="photo">
        <a href="<?= $url; ?>">
        <img src="<?php echo $originator->getProfileImage()->getUrl(); ?>">
        </a>
    </div>
	<?php endif; ?>
    <div class="notifi-wrap">
        <a href="<?= $url; ?>">
	        <?= $content; ?>
        </a>

        <div class="date"><?php echo humhub\widgets\TimeAgo::widget(['timestamp' => $record->created_at]); ?> </div>
    </div>
    <?php $objectAction = $record->getSourceObject();
        if(!(empty($objectAction) || $objectAction instanceof Friendship || $objectAction instanceof \humhub\modules\space\models\Space || $objectAction instanceof \humhub\modules\post\models\Post)) { ?>
	        <?= \humhub\modules\file\widgets\ShowPhotoPreview::widget(['object' => $objectAction->polymorphicRelation, 'options' => ['index' => 0, 'width' => 44, 'height' => 33]]) ?>
        <?php } ?>
    <div class="img-block">

    </div>
</li>