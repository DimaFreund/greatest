<?php
/**
 * @var \humhub\modules\space\models\Space $space
 * @var string $content
 */

$space = $this->context->contentContainer;
?>

<?php echo humhub\modules\space\widgets\Header::widget(['space' => $space]); ?>


    <div class="page-content">
	    <?= \humhub\modules\space\widgets\SpaceContent::widget([
		    'contentContainer' => $space,
		    'content' => $content
	    ]) ?>
    </div>

<?= \humhub\modules\user\widgets\RightSidebar::widget(); ?>