<?php

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
            <div class="star-rating"><span class="starVal">3.5</span><span class="counterVal">122</span></div>
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
            <?= $model->message; ?>
            <div class="albums-img-layout">
                <?= ShowPhotoPreview::widget(['object' => $model, 'options' => ['for' => 'dessireGallery']]); ?>
            </div>
        </div>
        <div class="footer">
            <div class="comments"><svg class="icon icon-comment_border"><use xlink:href="./svg/sprite/sprite.svg#comment_border"></use></svg><svg class="icon icon-comments"><use xlink:href="./svg/sprite/sprite.svg#comments"></use></svg>
                <div class="text">Comment</div>
                <div class="val">(<span>35</span>)</div>
            </div>
            <div class="like"><svg class="icon icon-like"><use xlink:href="./svg/sprite/sprite.svg#like"></use></svg><svg class="icon icon-liked"><use xlink:href="./svg/sprite/sprite.svg#liked"></use></svg>
                <div class="text">like</div>
                <div class="val">(<span>35</span>)</div>
            </div>
            <div class="share"><svg class="icon icon-share"><use xlink:href="./svg/sprite/sprite.svg#share"></use></svg>
                <div class="text">Share</div>
                <div class="val">(<span>12</span>)</div>
            </div>
            <div class="follow"><svg class="icon icon-star_fill"><use xlink:href="./svg/sprite/sprite.svg#star_fill"></use></svg><svg class="icon icon-star_empty"><use xlink:href="./svg/sprite/sprite.svg#star_empty"></use></svg></div>
        </div>
        <div class="comments-block">
            <div class="comment">
                <div class="author-img"><img src="img/profile_photo-2.jpg"></div><a class="author-name" href="">Christopher Lawrence:</a>
                <div class="comment-text">Well done!</div>
                <div class="comment-footer">
                    <div class="like">
                        <div class="text">Like</div>
                        <div class="val">(<span>102</span>)</div>
                    </div>
                    <div class="replay">
                        <div class="text">Replay</div>
                        <div class="val">(<span>102</span>)</div>
                    </div>
                    <div class="date">
                        <div class="val">17.03.2016</div>
                    </div>
                </div>
            </div>
            <div class="comment">
                <div class="author-img"><img src="img/profile_photo-1.jpg"></div><a class="author-name" href="">Mary Lockhart:</a>
                <div class="comment-text">Hey you! How are you?! I want to find a company to ascend Mount Everest!</div>
                <div class="comment-img"><img src="img/comment-img.png"></div>
                <div class="comment-footer">
                    <div class="like">
                        <div class="text">Like</div>
                        <div class="val">(<span>102</span>)</div>
                    </div>
                    <div class="replay">
                        <div class="text">Replay</div>
                        <div class="val">(<span>102</span>)</div>
                    </div>
                    <div class="date">
                        <div class="val">17.03.2016</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="comment-form">
            <div class="author-img"><img src="img/profile_photo-1.jpg"></div>
            <div class="textarea-block"><textarea placeholder="Your Comment" rows="1"></textarea></div><input type="submit" value="send"></div>
        <div class="sub-context-menu">
            <div class="context-menu-btn"><span></span><span></span><span></span></div>
            <ul class="context-menu">
                <li><a href="<?= Url::toRoute(['desire/update', 'id'=>$model->id]); ?>">Edit</a></li>
                <li><a href="<?= Url::toRoute(['desire/delete', 'id'=>$model->id],  ['data-pjax' => 0]); ?>">Remove</a></li>
            </ul>
        </div>
    </div>
</div>
</div>