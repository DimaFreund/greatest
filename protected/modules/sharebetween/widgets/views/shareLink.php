<?php
/* @var $this humhub\components\View */

use yii\helpers\Url;

humhub\modules\sharebetween\assets\ShareAsset::register($this);
?>
<?php if(!$mode) { ?>
<div data-action-click="share.toggleShare" style="cursor:pointer" data-action-url="<?=Url::to(['/sharebetween/share', 'id' => $id]); ?>" class="share">
    <svg class="icon icon-share">
        <use xlink:href="./svg/sprite/sprite.svg#share"></use>
    </svg>
    <div class="text"><?= Yii::t('base', 'Share'); ?></div>
    <div class="val shareCount">
	    <?php if ($count > 0) {
		    echo ' (' . $count . ')';
	    }
	    ?>
    </div>
</div>
<?php } else { ?>
    <div data-action-click="share.toggleShare" style="cursor:pointer" data-action-url="<?=Url::to(['/sharebetween/share', 'id' => $id]); ?>" class="share">
        <svg class="icon icon-share">
            <use xlink:href="./svg/sprite/sprite.svg#share"></use>
        </svg>
        <div class="val shareCount">
			<?php if ($count > 0) {
				echo $count;
			}
			?>
        </div>
    </div>
<?php } ?>
