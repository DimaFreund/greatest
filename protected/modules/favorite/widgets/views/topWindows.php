<?php
use humhub\modules\blog\models\Blog;
use humhub\modules\desire\models\Desire;
use humhub\modules\gallery\models\CustomGallery;
use humhub\modules\gallery\models\Media;
use humhub\modules\polls\models\Poll;

?>

<div class="latestList">
	<div class="list-header"><span>Latest</span></div>
	<ul>
        <?php
        foreach($latest as $item) { ?>
       <?= \humhub\modules\favorite\widgets\FavoriteLatest::widget(['latest' => $item]); ?>
        <?php } ?>
	</ul>
</div>
<div class="anotherFavorites">
	<ul>
		<li><a href="<?= $user->createUrl('/user/profile/favorite-photos'); ?>">Photos (<?= isset($counts[Media::className()])?$counts[Media::className()]:'0'; ?>)</a></li>
		<li><a href="<?= $user->createUrl('/user/profile/favorite-photo-albums'); ?>">Albums (<?= isset($counts[CustomGallery::className()])?$counts[CustomGallery::className()]:'0'; ?>)</a></li>
		<li><a href="<?= $user->createUrl('/user/profile/favorite-blog'); ?>">Blog Posts (<?= isset($counts[Blog::className()])?$counts[Blog::className()]:'0'; ?>)</a></li>
		<li><a href="<?= $user->createUrl('/user/profile/favorite-desires'); ?>">Desires (<?= isset($counts[Desire::className()])?$counts[Desire::className()]:'0'; ?>)</a></li>
		<li><a href="<?= $user->createUrl('/user/profile/favorite-polls'); ?>">Polls (<?= isset($counts[Poll::className()])?$counts[Poll::className()]:'0'; ?>)</a></li>
	</ul>
</div>
