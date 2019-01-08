<?php
/**
 * Created by PhpStorm.
 * User: work
 * Date: 02.07.18
 * Time: 16:49
 */

use humhub\modules\content\widgets\BottomPanelContent;
use humhub\modules\favorite\widgets\FavoriteLink;
use humhub\modules\like\widgets\LikeLink;

?>
<?php foreach($spaces as $space) { ?>
<li class="group">
	<a href="<?= $space->getUrl(); ?>">
		<div class="photo"><img src="<?php echo $space->getProfileImage()->getUrl(); ?>"></div>
		<div class="group-wrap">
			<div class="title"><?= $space->name; ?></div>
			<div class="category"><?= isset($category[$space->category])?$category[$space->category]:''; ?></div>
			<div class="text"><?= $space->description; ?></div>
		</div>
	</a>
	<div class="statistic-info">
		<div class="subscribers"><svg class="icon icon-members"><use xlink:href="./svg/sprite/sprite.svg#members"></use></svg>
			<div class="val"><?= $space->getMemberships()->count(); ?></div>
		</div>
		<?= LikeLink::widget(['object' => $space, 'mode' => BottomPanelContent::SMALL_MODE]); ?>
        <?= FavoriteLink::widget(['object' => $space, 'mode' => BottomPanelContent::SMALL_MODE]); ?>

	</div>
</li>
<?php } ?>
