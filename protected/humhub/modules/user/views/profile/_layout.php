<?php
$user = $this->context->getUser();
?>



	<?= \humhub\modules\user\widgets\ProfileHeader::widget( [ 'user' => $user ] ); ?>
    <div class="page-content">
		<?php echo $content; ?>
    </div>
    <?= \humhub\modules\user\widgets\RightSidebar::widget(); ?>

