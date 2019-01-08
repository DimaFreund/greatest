<?php
/**
 * Created by PhpStorm.
 * User: work
 * Date: 13.06.18
 * Time: 17:55
 */
?>

<?php if(!$mode) { ?>
<a class="comments" href="<?= $user->createUrl($url, ['id' => $object->id]); ?>#comments-block">
	<svg class="icon icon-comment_border">
		<use xlink:href="./svg/sprite/sprite.svg#comment_border"></use>
	</svg>
	<svg class="icon icon-comments">
		<use xlink:href="./svg/sprite/sprite.svg#comments"></use>
	</svg>
	<div class="text">Comment</div>
    <?php if($commentCount) { ?>
	<div class="val">(<span><?= $commentCount; ?></span>)</div>
    <?php } ?>
	<div class="tooltip-base">Leave a comment</div>
</a>
<?php } else { ?>
    <a class="comments" href="<?= $user->createUrl($url, ['id' => $object->id]); ?>#comments-block">
        <svg class="icon icon-comments">
            <use xlink:href="./svg/sprite/sprite.svg#comments"></use>
        </svg>
	    <?php if($commentCount) { ?>
            <div class="val">(<span><?= $commentCount; ?></span>)</div>
	    <?php } ?>
    </a>
<?php } ?>