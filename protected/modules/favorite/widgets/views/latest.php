<?php
/**
 * Created by PhpStorm.
 * User: work
 * Date: 14.08.18
 * Time: 12:01
 */

use humhub\modules\space\models\Space;
use humhub\modules\user\models\User;
use yii\helpers\Url;

?>

<li class="favorite">
	<div class="photo">
		<?=
		\humhub\modules\user\widgets\Image::widget([
			'user' => $user,
			'width' => false,
		]);
		?>
    </div>
	<div class="favorite-wrap has-img">
		<div class="text">

			<div class="name"><a href="<?= $user->createUrl(); ?>">
                    <?= $user->displayName; ?>`s</a>
            </div>
            <?php if(!($object instanceof User || $object instanceof Space)) { ?>
            <?= $object->objectName(); ?>:
            <a href="<?= Url::toRoute(['/content/perma/', 'id' => $object->content->id]); ?>">
                <?= $object->title; ?>
            </a>
            <?php } ?>
        </div>
		<div class="img-block"><?= \humhub\modules\file\widgets\ShowPhotoPreview::widget(['object' => $object, 'options' => ['index' => 0, 'width' => 44, 'height' => 33]]) ?></div>

		<div class="date"><?= \humhub\widgets\TimeAgo::widget(['timestamp' => $latest->created_at]); ?></div>
	</div>
</li>
