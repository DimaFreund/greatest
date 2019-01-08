<?php
$user = $this->context->contentContainer;
?>




<?= \humhub\modules\user\widgets\ProfileHeaderDesire::widget(['user' => $user]); ?>
    <div class="page-content">
<?php echo $content; ?>
    </div>

<?= \humhub\modules\user\widgets\RightSidebar::widget(); ?>