<?php
/**
 * Created by PhpStorm.
 * User: work
 * Date: 19.06.18
 * Time: 15:20
 */?>

<?php foreach($articles as $article) { ?>
	<div class="desire"><a class="desire-img" href="<?= $article->user->createUrl('/user/profile/desire-one', ['id' => $article->id]); ?>"><?= \humhub\modules\file\widgets\ShowPhotoPreview::widget(['object' => $article, 'options' => ['width' => 240, 'height' => 240, 'index' => 0]]); ?></a>
		<div class="info-short">
			<div class="bottom">
				<div class="img-block"><a href="<?= $article->user->createUrl(); ?>"><img src="<?= $article->user->getProfileImage()->getUrl(); ?>"></a></div>
				<div class="wrap">
					<div class="desire-top">
						<div class="name"><a href="<?= $article->user->createUrl(); ?>"><?= $article->user->username ?></a></div>
						<?= \humhub\modules\rating\widgets\RatingDisplay::widget(['object' => $article]); ?>
					</div>
					<div class="desire-text">
						<a class="text favorite" href="<?= $article->user->createUrl('/user/profile/desire-one', ['id' => $article->id]); ?>">
							<!-- If disere is favorite add class favorite & add icon-->
							<?php if($article->greatest) { ?>
								<svg class="icon icon-earth_green">
									<use xlink:href="./svg/sprite/sprite.svg#earth_green"></use>
								</svg>
							<?php } ?>
							<?= $article->title; ?></a>
						<ul
							class="tags">
							<?= \humhub\modules\tags\widgets\DisplayTags::widget(['user' => $article]); ?>

						</ul>
					</div>
					<div class="desire-bottom">
						<?= \humhub\modules\content\widgets\BottomPanelContent::widget([
							'object' => $article,
							'commentLinkPage' => true,
							'ratingLink' => true,
							'options' => [
								'commentPageUrl' => '/user/profile/desire-one'
							]
						]); ?>

					</div>
				</div>
			</div>
		</div>
	</div>

<?php } ?>