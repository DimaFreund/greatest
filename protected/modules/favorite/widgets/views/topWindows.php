<?php
use humhub\modules\blog\models\Blog;
use humhub\modules\desire\models\Desire;
use humhub\modules\gallery\models\CustomGallery;
use humhub\modules\gallery\models\Media;
use humhub\modules\polls\models\Poll;

?>

<div class="latestList">
	<div class="list-header"><span><?= Yii::t('base','Latest'); ?></span></div>
	<ul>
        <?php
        foreach($latest as $item) { ?>
       <?= \humhub\modules\favorite\widgets\FavoriteLatest::widget(['latest' => $item]); ?>
        <?php } ?>
	</ul>
</div>
<div class="anotherFavorites">
	<ul>
		<li><a href="<?= $user->createUrl('/user/profile/favorite-photos'); ?>"><?= Yii::t('base','Photos'); ?> (<?= isset($counts[Media::className()])?$counts[Media::className()]:'0'; ?>)</a></li>
		<li><a href="<?= $user->createUrl('/user/profile/favorite-photo-albums'); ?>"><?= Yii::t('base','Albums'); ?> (<?= isset($counts[CustomGallery::className()])?$counts[CustomGallery::className()]:'0'; ?>)</a></li>
		<li><a href="<?= $user->createUrl('/user/profile/favorite-blog'); ?>"><?= Yii::t('base','Blog Posts'); ?> (<?= isset($counts[Blog::className()])?$counts[Blog::className()]:'0'; ?>)</a></li>
		<li><a href="<?= $user->createUrl('/user/profile/favorite-desires'); ?>"><?= Yii::t('base','Desires'); ?> (<?= isset($counts[Desire::className()])?$counts[Desire::className()]:'0'; ?>)</a></li>
		<li><a href="<?= $user->createUrl('/user/profile/favorite-polls'); ?>"><?= Yii::t('base','Polls'); ?> (<?= isset($counts[Poll::className()])?$counts[Poll::className()]:'0'; ?>)</a></li>
	</ul>
</div>
