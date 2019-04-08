<?php

use humhub\modules\content\widgets\BottomPanelContent;
use humhub\modules\favorite\widgets\FavoriteLink;
use humhub\modules\like\widgets\LikeLink;

$category = new \humhub\modules\content\models\Category();
$category = $category->getAllCurrentLanguage( Yii::$app->language, 'space' );
?>


<div class="group-post">
	<div class="img-block"><a href="<?= $space->getUrl(); ?>"><img
				src="<?php echo $space->getProfileImage()->getUrl(); ?>"></a></div>
	<div class="description-block">
		<div class="title"><a href="<?= $space->getUrl(); ?>"><?= $space->name; ?></a></div>
		<div class="subtitle"><?= isset($category[ $space->category ])?$category[ $space->category ]:''; ?></div>
		<div class="text"><?= \humhub\widgets\RichText::widget(['text' => $space->description, 'maxLength' => 190]); ?></div>
		<div class="footer">
			<div class="subscribers">
				<svg class="icon icon-members">
					<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="./svg/sprite/sprite.svg#members"></use>
				</svg>
				<div class="val"><?= $space->getMemberships()->count(); ?></div>
			</div>
			<?= LikeLink::widget( [ 'object' => $space, 'mode' => BottomPanelContent::SMALL_MODE ] ); ?>
			<?= FavoriteLink::widget( [ 'object' => $space, 'mode' => BottomPanelContent::SMALL_MODE ] ); ?>
		</div>
	</div>
</div>