<?php

use humhub\modules\comment\widgets\Comments;
use humhub\modules\file\widgets\ShowPhotoPreview;

?>
<div class="page-content">
    <div class="content-wrap">
        <div class="blog-single comments-node personal-profile">
            <div class="blog-top">
                <div class="date"><?= \humhub\widgets\TimeAgo::widget( [ 'timestamp' => $model->created_at ] ); ?></div>
                <div class="title"><?= $model->title; ?></div>
                <div class="category"><?= isset($category[ $model->category ])?$category[ $model->category ]:''; ?></div>
            </div>
            <div class="description">
                <div class="blog-img">
					<?= ShowPhotoPreview::widget( [ 'object'  => $model,
					                                'options' => [ 'index' => 0, 'width' => 800, 'height' => 550 ]
					] ); ?>
                </div>
				<?= $model->message; ?>
                <div class="albums-img-layout">
					<?= ShowPhotoPreview::widget( [ 'object'  => $model,
					                                'options' => [ 'for' => 'dessireGallery' ]
					] ); ?>
                </div>
            </div>
            <div class="footer">
				<?= \humhub\modules\content\widgets\BottomPanelContent::widget( [ 'object' => $model ] ); ?>
            </div>
			<?= Comments::widget( [ 'object' => $model ] ); ?>
<!--            <div class="sub-context-menu">-->
<!--                <div class="context-menu-btn"><span></span><span></span><span></span></div>-->
<!--                <ul class="context-menu">-->
<!--                    <li><a href="#">Edit</a></li>-->
<!--                    <li><a href="#">Edit 2</a></li>-->
<!--                    <li><a href="#">Edit 3</a></li>-->
<!--                </ul>-->
<!--            </div>-->
        </div>
    </div>
</div>