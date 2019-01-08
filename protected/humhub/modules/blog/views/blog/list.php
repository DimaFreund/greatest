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
                    <div class="page-filter category-filter show-on-tablet"><select><option>Activities (1)</option><option>Success Stories (34434)</option><option>Culture (34)</option><option>Food&Drink (643)</option><option>Fashion&Style (45)</option><option>Business&Money (46)</option></select></div>
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

