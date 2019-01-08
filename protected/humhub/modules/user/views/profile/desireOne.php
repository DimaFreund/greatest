<?php

use humhub\modules\comment\widgets\Comments;
use humhub\modules\file\widgets\ShowFiles;
use humhub\modules\file\widgets\ShowPhotoPreview;
use humhub\modules\tags\widgets\DisplayTags;
use humhub\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
?>
<div class="content-wrap">
    <div class="personal-profile-desire-single comments-node">
        <div class="desire-top">
            <div class="title">My Desire is…</div>
	        <?= \humhub\modules\rating\widgets\RatingDisplay::widget(['object' => $model]); ?>
        </div>
        <div class="desire-text">
            <div class="text"><?= $model->title; ?></div>
            <ul class="tags">
				<?= DisplayTags::widget(['user' => $model]); ?>
            </ul>
        </div>
        <div class="description">
            <div class="date"><?= \humhub\widgets\TimeAgo::widget(['timestamp' => $model->created_at]); ?></div>
            <div class="desire-img">
				<?= ShowPhotoPreview::widget(['object' => $model, 'options' => ['index' => 0, 'width' => 800, 'height' => 550]]); ?>
            </div>
	        <?= humhub\widgets\RichText::widget(['text' => $model->message, 'record' => $model, 'markdown' => true]) ?>
            <div class="albums-img-layout">
				<?= ShowPhotoPreview::widget(['object' => $model, 'options' => ['for' => 'dessireGallery']]); ?>
            </div>
        </div>
        <div id="comments-block" class="footer">

            <?= \humhub\modules\content\widgets\BottomPanelContent::widget(['object' => $model, 'ratingLink' => 1]); ?>
        </div>
	    <?= Comments::widget(['object' => $model]); ?>

        <div class="sub-context-menu">
            <div class="context-menu-btn"><span></span><span></span><span></span></div>
            <ul class="context-menu">
                <li><a href="<?= Url::toRoute(['/desire/desire/update', 'id'=>$model->id]); ?>">Edit</a></li>
                <li><a href="<?= Url::toRoute(['/desire/desire/delete', 'id'=>$model->id],  ['data-pjax' => 0]); ?>">Remove</a></li>
            </ul>
        </div>
    </div>
</div>
<div class="base-btn"><a href="<?= $user->createUrl('/user/profile/desires'); ?>">Back to list</a></div>
