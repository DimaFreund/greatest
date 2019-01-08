<?php
/**
 * Created by PhpStorm.
 * User: work
 * Date: 21.06.18
 * Time: 14:43
 */

use humhub\modules\content\widgets\BottomPanelContent;
use humhub\modules\gallery\models\SquarePreviewImage;

?>

<div class="content-wrap">
	<div class="personal-profile-photos comments-node">
		<ul class="small-tabs-controls">
			<li class="<?= ($this->context->action->id === 'photo-albums')? 'active': ''; ?>"><a href="<?= $this->context->contentContainer->createUrl('/user/profile/photo-albums'); ?>">Albums</a></li>
			<li class="<?= ($this->context->action->id === 'favorite-photo-albums')? 'active': ''; ?>"><a href="<?= $this->context->contentContainer->createUrl('/user/profile/favorite-photo-albums'); ?>">Favorite albums</a></li>
		</ul>

		<div class="albums-layout">
            <?php foreach( $albums as $album ) { ?>
                <?php $metaData = $album->getMetaData(); ?>
			    <div class="album">
				<div class="img-block"><img src="<?= $metaData['thumbnailUrl']; ?>">
					<div class="category"><?= isset($category[$album->category])?$category[$album->category]:''; ?></div>
				</div>
				<div class="desc"><a class="title" href="<?= $this->context->contentContainer->createUrl('/user/profile/photos', ['id' => $album->id]); ?>"><?= $album->title; ?></a>
					<div class="img-counter"><?= count($album->getMediaList()); ?> photos</div>
					<div class="statistic-info">
                        <?= BottomPanelContent::widget(['object' => $album, 'commentLinkPage' => true, 'mode' => BottomPanelContent::SMALL_MODE, 'options' => ['commentPageUrl' => '/user/profile/photos']]); ?>
					</div>
				</div>
				<div class="sub-context-menu">
					<div class="context-menu-btn"><span></span><span></span><span></span></div>
					<?php if ($metaData['wallUrl'] || $metaData['downloadUrl'] || ($metaData['writeAccess'] && ($metaData['deleteUrl'] || $metaData['editUrl']))): ?>

                                <ul class="context-menu">
									<?php if ($metaData['wallUrl']): ?>
                                        <li>
                                            <a href="<?= $metaData['wallUrl'] ?>"><i class="fa fa-link"></i> <?= Yii::t('GalleryModule.base', 'Show connected post') ?></a>
                                        </li>
									<?php endif; ?>
									<?php if ($metaData['writeAccess']): ?>
										<?php if ($metaData['deleteUrl']): ?>
                                            <li>
                                                <a data-action-click="ui.modal.post" data-action-url="<?= $metaData['deleteUrl'] ?>"
                                                   data-action-confirm-header="<?= Yii::t('GalleryModule.base', '<strong>Confirm</strong> delete item') ?>"
                                                   data-action-confirm="<?= Yii::t('GalleryModule.base', 'Do you really want to delete this item with all related content?') ?>">
                                                    <i class="fa fa-trash"></i> <?= Yii::t('GalleryModule.base', 'Delete') ?>
                                                </a>
                                            </li>
										<?php endif; ?>
										<?php if ($metaData['editUrl']): ?>
                                            <li>
                                                <a data-target="#globalModal" href="<?= $metaData['editUrl'] ?>"><i class="fa fa-edit"></i> <?= Yii::t('GalleryModule.base', 'Edit') ?></a>
                                            </li>
										<?php endif; ?>
									<?php endif; ?>
									<?php if ($metaData['downloadUrl']): ?>
                                        <li>
                                            <a data-pjax-prevent="1" href="<?= $metaData['downloadUrl'] ?>"><i class="fa fa-download"></i> <?= Yii::t('GalleryModule.base', 'Download') ?></a>
                                        </li>
									<?php endif; ?>
                                </ul>
					<?php endif; ?>
				</div>
			</div>
            <?php } ?>
		</div>

	</div>
</div>
