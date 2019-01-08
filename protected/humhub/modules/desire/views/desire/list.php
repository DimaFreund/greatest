


<div class="page-content">
    <div class="content-wrap grey">
        <div class="desires-page">
            <div class="desires-page-header">
                <div class="title">Desires</div>
                <div class="stat"><?= $count; ?> desires</div>
                <div class="map-btn"><svg class="icon icon-location"><use xlink:href="./svg/sprite/sprite.svg#location"></use></svg>view on map</div>
                <div class="map-block"><iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d81217.46868235002!2d30.48229395!3d50.49610355!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sru!2sua!4v1526995954734" width="600" height="350" frameborder="0"
                                               style="border:0" allowfullscreen></iframe></div>
            </div>
            <div class="desire-page-filter">
                <div class="filter-title">TOP reated</div>
                <?= \humhub\modules\content\widgets\PageSortFilter::widget(['models' => $articles]); ?>
            </div>
            <div class="all-desires desire-small-layout" id="list-object">
                <?php $counter = 0; ?>
				<?php foreach($articles as $article) { ?>
                    <div class="desire <?php if($counter < 3) echo 'isBigger'; $counter++ ?>"><a class="desire-img" href="<?= $article->user->createUrl('/user/profile/desire-one', ['id' => $article->id]); ?>"><?= \humhub\modules\file\widgets\ShowPhotoPreview::widget(['object' => $article, 'options' => ['width' => 240, 'height' => 240, 'index' => 0]]); ?></a>
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
                                        <ul class="tags">
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
        </div>
    </div>
    <?= \humhub\widgets\LoadMoreButton::widget(['count' => $count, 'object' => $articles, 'ajaxUrl' => $ajaxUrl]); ?>
</div>
