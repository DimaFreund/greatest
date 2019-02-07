<?php
/**
 * Created by PhpStorm.
 * User: work
 * Date: 13.03.18
 * Time: 13:24
 */

use humhub\modules\comment\widgets\Comments;
?>
<div class="page-content">
    <div class="content-wrap">
        <div class="blog-post-list blog-page">
            <div class="blog-page-header">
                <div class="title"><?= $title; ?></div>
                <div class="stat"><?= $count; ?> <?= $title; ?> Posts</div>
                <div class="filters">
                    <?= \humhub\modules\content\widgets\CategorySelectFilter::widget(['model' => Yii::$app->controller->module->id]); ?>
                   <?= \humhub\modules\content\widgets\PageSortFilter::widget(['models' => $articles]); ?>
                </div>
            </div>
            <div id="list-object">
            <?= $this->render('_list', ['articles' => $articles, 'category' => $category]); ?>
            </div>

        </div>
    </div>
    <?= \humhub\widgets\LoadMoreButton::widget(['count' => $count, 'object' => $articles, 'ajaxUrl' => $ajaxUrl]); ?>
</div>

