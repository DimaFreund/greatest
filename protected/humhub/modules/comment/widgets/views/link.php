<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>


<div onclick="$('#comment_<?= $id ?>').slideToggle('fast');$('#newCommentForm_<?= $id ?>').focus();return false;" class="comments"><svg class="icon icon-comment_border"><use xlink:href="./svg/sprite/sprite.svg#comment_border"></use></svg><svg class="icon icon-comments"><use xlink:href="./svg/sprite/sprite.svg#comments"></use></svg>
    <div class="text"><?= Yii::t('CommentModule.widgets_views_link', "Comment") ?></div>
    <div class="val">(<span><?= $count; ?></span>)</div>
</div>

