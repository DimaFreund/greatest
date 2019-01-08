<?php

use humhub\modules\file\libs\FileHelper;
use humhub\libs\Html;

?>
<div class="wraper-albums album-post">
    <div class="img-albums">
        <div class="pull-left" style="min-height:133px;">
            <a href="<?= $gallery->content->container->createUrl( '/user/profile/photos', [ 'id' => $gallery->id ] ); ?>">

                <img src="<?= $gallery->previewImageUrl; ?>" alt="">

            </a>
        </div>
    </div>
    <div class="info-albums">
        <div class="title">
		<?php if ( ! empty( $gallery->description ) ): ?>
			<?= Html::encode( $gallery->description ); ?>
		<?php endif; ?>
        </div>
        <div class="sub-title">
			<?php if ( $gallery->title ) : ?>
                <strong><?= Yii::t( 'GalleryModule.base', 'Gallery:' ); ?></strong> <a
                        href="<?php $gallery->content->container->createUrl( '/user/profile/photos', [ 'id' => $gallery->id ] ); ?>"><?= Html::encode( $gallery->title ) ?></a>
                <br/>
			<?php endif ?>
            <div class="subtitle"><?= $category; ?></div>
        </div>

        <div class="clearfix"></div>
    </div>
</div>