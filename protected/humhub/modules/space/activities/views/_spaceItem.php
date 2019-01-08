<?php

use humhub\modules\content\widgets\BottomPanelContent;
use humhub\modules\favorite\widgets\FavoriteLink;
use humhub\modules\like\widgets\LikeLink;

$category = new \humhub\modules\content\models\Category();
$category = $category->getAllCurrentLanguage( Yii::$app->language, 'space' );
?>


<div class="group-post">
	<div class="img-block"><a href="<?= $source->getUrl(); ?>"><img
				src="<?php echo $source->getProfileImage()->getUrl(); ?>"></a></div>
	<div class="description-block">
		<div class="title"><a href="<?= $source->getUrl(); ?>"><?= $source->name; ?></a></div>
		<div class="subtitle"><?= isset($category[ $source->category ])?$category[ $source->category ]:''; ?></div>
		<div class="text"><?= \humhub\widgets\RichText::widget(['text' => $source->description, 'maxLength' => 190]); ?></div>
		<div class="footer">
			<div class="subscribers">
				<svg class="icon icon-members">
					<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="./svg/sprite/sprite.svg#members"></use>
				</svg>
				<div class="val"><?= $source->getMemberships()->count(); ?></div>
			</div>
			<?= LikeLink::widget( [ 'object' => $source, 'mode' => BottomPanelContent::SMALL_MODE ] ); ?>
			<?= FavoriteLink::widget( [ 'object' => $source, 'mode' => BottomPanelContent::SMALL_MODE ] ); ?>
		</div>
	</div>
</div>