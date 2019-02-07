<?php
/**
 * Created by PhpStorm.
 * User: work
 * Date: 26.10.18
 * Time: 10:41
 */

use humhub\modules\blog\models\Blog;
use humhub\modules\comment\widgets\Comments;
use humhub\modules\desire\models\Desire;
use humhub\modules\file\converter\PreviewImage;
use humhub\modules\gallery\models\CustomGallery;
use humhub\modules\gallery\models\Media;
use humhub\modules\user\models\User;

?>

<div class="page-content">
    <div class="content-wrap">
        <div class="favorite-page">
        <h2>Favorites</h2>
        <div class="wraper-group-content content-media">
            <h3>Photos (<?= (isset($counts[Media::className()])?$counts[Media::className()]:0); ?>)</h3>
	        <?php foreach($photos as $photo) { ?>

		        <?php
                $photo = $photo->baseFile;
		        $photoPreview = new PreviewImage;

			        $photoPreview->options = [
				        'mode'   => 'force',
				        'width'  => 251,
				        'height' => 171,
			        ];
		        $photoPreview->applyFile($photo);
		        ?>
		        <?php $user = User::findOne($photo->created_by); ?>
                <div class="item"><a href="<?= $user->createUrl('/user/profile/photo-one', ['id' => $photo->object_id]); ?>"><img src="<?= $photoPreview->getUrl(); ?>"></a></div>


	        <?php } ?>
            <div class="link-all-elements">
                <a href="<?= Yii::$app->user->getIdentity()->createUrl('/user/profile/favorite-photos'); ?>">View all</a>
            </div>
        </div>
        <div class="wraper-group-content content-album">
            <h3>Albums (<?= (isset($counts[CustomGallery::className()])?$counts[CustomGallery::className()]:0); ?>)</h3>
            <div class="albums-layout" id="list-albums">
	        <?php foreach($albums as $album) { ?>
                <div class="album public-album">
			        <?php $metaData = $album->getMetaData(); ?>
                    <div class="img-block"><img src="<?= $metaData['thumbnailUrl']; ?>">
                        <div class="category"><?= isset($category[$album->category])?$category[$album->category]:''; ?></div>
                    </div>
                    <div class="desc">
                        <div class="author-block">
					        <?php $user = User::findOne($album->content->created_by); ?>
                            <div class="photo">
                                <a href="<?= $user->createUrl('/user/profile/home'); ?>">
                                    <img src="<?= $user->getProfileImage()->getUrl(); ?>">
                                </a>
                            </div>
                            <a href="<?= $user->createUrl('/user/profile/home'); ?>">
                                <div class="name"><?= $user->username; ?></div>
                            </a>
                        </div><a class="title" href="<?= $user->createUrl('/user/profile/photos', ['id' => $album->id]); ?>"><?= $album->title; ?></a>
                        <div class="img-counter"><?= count($album->getMediaList()); ?> photos</div>
                        <div class="statistic-info">
					        <?= \humhub\modules\content\widgets\BottomPanelContent::widget(['object' => $album, 'commentLinkPage' => true, 'options' => ['commentPageUrl' => '/user/profile/photos'], 'mode' => \humhub\modules\content\widgets\BottomPanelContent::SMALL_MODE]); ?>

                        </div>
                    </div>
                </div>
	        <?php } ?>
            </div>

            <div class="link-all-elements">
                <a href="<?= Yii::$app->user->getIdentity()->createUrl('/user/profile/favorite-photo-albums'); ?>">View all</a>
            </div>
        </div>
        <div class="wraper-group-content content-blog">
            <h3>Blog posts (<?= (isset($counts[Blog::className()])?$counts[Blog::className()]:0); ?>)</h3>

            <?php foreach($blogs as $article) { ?>
	        <?php $user = User::findOne($article->created_by); ?>
            <div class="base-post">
                <div class="header">
                    <div class="user-img"><a href="<?= $user->createUrl('/'); ?>"><img src="<?= $user->getProfileImage()->getUrl(); ?>"></a></div>
                    <div class="wrap">
                        <div class="name"><a href="<?= $user->createUrl('/'); ?>"><?= $user->username; ?></a></div>
                        <div class="date"><?= \humhub\widgets\TimeAgo::widget(['timestamp' => $article->created_at]); ?></div>
                    </div>
                </div>
                <div class="content">
                    <div class="article-post">
                        <div class="img-block">
                            <a href="<?= $user->createUrl('/user/profile/blog-one', ['id' => $article->id]); ?>">
						        <?= \humhub\modules\file\widgets\ShowPhotoPreview::widget(['object' => $article]); ?>
                            </a>
                        </div>
                        <div class="description-block">
                            <div class="title"><a href="<?= $user->createUrl('/user/profile/blog-one', ['id' => $article->id]); ?>"><?= $article->title; ?></a></div>
                            <div class="subtitle"><?= isset($category[$article->category])?$category[$article->category]:''; ?></div>
                            <div class="text"><?= \humhub\widgets\RichText::widget(['text' => $article->message, 'maxLength' => 40]); ?></div>
                        </div>
                    </div>
                </div>
                <div class="footer">
			        <?= \humhub\modules\content\widgets\BottomPanelContent::widget(['object' => $article]); ?>
                </div>

		        <?= Comments::widget(['object' => $article]); ?>
            </div>
            <?php } ?>

            <div class="link-all-elements">
                <a href="<?= Yii::$app->user->getIdentity()->createUrl('/user/profile/favorite-blog'); ?>">View all</a>
            </div>
        </div>
        <div class="wraper-group-content content-desire">
            <h3>Desires (<?= isset($counts[Desire::className()])?$counts[Desire::className()]:0; ?>)</h3>
            <div class="all-desires desire-small-layout">
	        <?php foreach($desires as $article) { ?>
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
                                    <a class="text <?php if($article->greatest && $article->id === $article->user->greatest_desire) { ?>favorite <?php } ?>" href="<?= $article->user->createUrl('/user/profile/desire-one', ['id' => $article->id]); ?>">
                                        <!-- If disere is favorite add class favorite & add icon-->
								        <?php if($article->greatest && $article->id === $article->user->greatest_desire) { ?>
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
            </div>
            <div class="link-all-elements">
                <a href="<?= Yii::$app->user->getIdentity()->createUrl('/user/profile/favorite-desires'); ?>">View all</a>
            </div>
        </div>
        </div>
    </div>
</div>
