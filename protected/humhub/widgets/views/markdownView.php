<?php

use Emojione\Client;
use Emojione\Ruleset;

$this->registerJsFile('@web-static/resources/js/highlight.js/highlight.pack.js', [ 'position' => yii\web\View::POS_BEGIN]);
$this->registerCssFile('@web-static/resources/js/highlight.js/styles/' . $highlightJsCss . '.css');
?>
<div class="markdown-render">
    <?= \humhub\widgets\EmojiConvertToImage::widget(['content' => $content]); ?>
</div>

<script>
    $(function () {
        $("pre code").each(function (i, e) {
            hljs.highlightBlock(e);
        });
    });
</script>