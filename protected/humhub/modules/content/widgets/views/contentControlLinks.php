<?php use humhub\modules\content\widgets\WallEntryControls; ?>


    <div class="sub-context-menu">
        <div class="context-menu-btn"><span></span><span></span><span></span></div>
        <ul class="context-menu">
			<?= WallEntryControls::widget([
				'object' => $contentObject,
				'wallEntryWidget' => $wallEntryWidget,
			]); ?>
        </ul>
    </div>


