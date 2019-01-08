<?php
/**
 * Created by PhpStorm.
 * User: work
 * Date: 20.06.18
 * Time: 11:08
 */

use yii\helpers\Html;

?>

<div class="content-wrap">
	<div class="profile-groups">
		<div class="title">Groups </div>
		<ul class="groups-list">
			<?php if (count($spaces) === 0): ?>
                    <p><?php echo Yii::t('SpaceModule.base', 'No spaces found.'); ?></p>
			<?php endif; ?>
            <?php foreach ($spaces as $space) { ?>
			    <li class="group">
				<a href="<?= $space->getUrl(); ?>">
					<div class="photo"><img src="<?php echo $space->getProfileImage()->getUrl(); ?>"></div>
					<div class="group-wrap">
						<div class="title"><?php echo Html::encode($space->name); ?></div>
						<div class="category"><?= isset($category[$space->category])?$category[$space->category]:''; ?></div><?php //TODO add display category Group; ?>
						<div class="text"><?php echo Html::encode($space->description); ?></div>
					</div>
				</a>
				<div class="statistic-info">
					<div class="subscribers"><svg class="icon icon-members"><use xlink:href="./svg/sprite/sprite.svg#members"></use></svg>
						<div class="val"><?= $space->getMemberships()->count(); ?></div>
					</div>
                    <?= \humhub\modules\like\widgets\LikeLink::widget(['object' => $space, 'mode' => true]); ?>
                    <?= \humhub\modules\favorite\widgets\FavoriteLink::widget(['object' => $space, 'mode' => true]); ?>
				</div>
			</li>
            <?php } ?>
		</ul>
	</div>
</div>
