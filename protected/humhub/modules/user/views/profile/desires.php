<?php
/**
 * Created by PhpStorm.
 * User: work
 * Date: 30.05.18
 * Time: 14:53
 */

use humhub\modules\tags\widgets\DisplayTags;
use yii\helpers\Html;
use yii\helpers\Url;

?>


    <div class="personal-profile-greatest-desire">
        <div class="desire-img">
            <a href="<?= $contentContainer->createUrl('/user/profile/desire-one', ['id' => $greatestDesire->id]); ?>">
			<?= \humhub\modules\file\widgets\ShowPhotoPreview::widget( [
				'object'  => $greatestDesire,
				'options' => [
					'index'  => 0,
					'height' => 370,
					'width'  => 370,
				]
			] ); ?>
            </a>
        </div>
        <div class="info-short">
            <div class="bottom">
                <div class="wrap">
                    <div class="desire-top">
                        <div class="title"><svg class="icon icon-earth_green"><use xlink:href="./svg/sprite/sprite.svg#earth_green"></use></svg><?= Yii::t('base','My Greatest Desire is'); ?>…</div>
	                    <?= \humhub\modules\rating\widgets\RatingDisplay::widget(['object' => $greatestDesire]); ?>
                    </div>
                    <div class="desire-text">
                        <a href="<?= $contentContainer->createUrl('/user/profile/desire-one', ['id' => $greatestDesire->id]); ?>"><div class="text"><?= $greatestDesire->title; ?></div></a>
                        <ul class="tags">
							<?= DisplayTags::widget(['user' => $greatestDesire]); ?>
                        </ul>
                    </div>
                    <div class="desire-bottom">
	                    <?= \humhub\modules\content\widgets\BottomPanelContent::widget(['object' => $greatestDesire, 'ratingLink' => true, 'commentLinkPage' => true, 'options' => ['commentPageUrl' => '/user/profile/desire-one']]); ?>
                    </div>
                </div>
            </div>
	        <?php if($greatestDesire->content->canEdit()) { ?>
            <div class="sub-context-menu">
                <div class="context-menu-btn"><span></span><span></span><span></span></div>
                <ul class="context-menu">
                    <li><a href="<?= Url::toRoute(['/desire/desire/update', 'id'=>$greatestDesire->id]); ?>">Edit</a></li>
                </ul>
            </div>
            <?php } ?>
        </div>
    </div>

	<div class="content-wrap">
		<div class="personal-profile-all-desires">
            <ul class="small-tabs-controls">
                <li class="<?= ($this->context->action->id === 'desires')? 'active': ''; ?>"><a href="<?= $contentContainer->createUrl('/user/profile/desires'); ?>"><?= Yii::t('base','My Desires'); ?></a></li>
                <li class="<?= ($this->context->action->id === 'favorite-desires')? 'active': ''; ?>"><a href="<?= $contentContainer->createUrl('/user/profile/favorite-desires'); ?>"><?= Yii::t('base','Favorite desires'); ?></a></li>
            </ul>
			<div class="all-desires">
                <?php foreach($desireList as $desire) { ?>
				<div class="desire"><a class="desire-img" href="<?= Url::toRoute(['/desire/desire/view', 'id'=>$desire->id]); ?>">
                <?= \humhub\modules\file\widgets\ShowPhotoPreview::widget( [
							'object'  => $desire,
							'options' => [
								'index'  => 0,
								'height' => 160,
								'width'  => 160
							]
						] ); ?>
                </a>
					<div class="info-short">
						<div class="bottom">
							<div class="wrap">
								<div class="desire-top">
									<div class="title"><?= Yii::t('base','My Desire is…'); ?></div>
									<?= \humhub\modules\rating\widgets\RatingDisplay::widget(['object' => $desire]); ?>
								</div>
								<div class="desire-text"><a class="text" href="<?= $contentContainer->createUrl('/user/profile/desire-one', ['id' => $desire->id]); ?>"><?= $desire->title; ?></a>
									<ul class="tags">
										<?= DisplayTags::widget(['user' => $desire]); ?>
									</ul>
								</div>
								<div class="desire-bottom">
                                    <?= \humhub\modules\content\widgets\BottomPanelContent::widget(['object' => $desire, 'ratingLink' => true, 'commentLinkPage' => true, 'options' => ['commentPageUrl' => '/user/profile/desire-one']]); ?>
								</div>
							</div>
						</div>
						<?php if($desire->content->canEdit()) { ?>
						<div class="sub-context-menu">
							<div class="context-menu-btn"><span></span><span></span><span></span></div>
							<ul class="context-menu">
                                <li><a href="<?= Url::toRoute(['/desire/desire/update', 'id'=>$desire->id]); ?>"><?= Yii::t('base','Edit'); ?></a></li>
                                <li><a href="<?= Url::toRoute(['/desire/desire/delete', 'id'=>$desire->id],  ['data-pjax' => 0]); ?>"><?= Yii::t('base','Remove'); ?></a></li>
							</ul>
						</div>
                        <?php } ?>
					</div>
				</div>
                <?php } ?>

			</div>
		</div>
	</div>

