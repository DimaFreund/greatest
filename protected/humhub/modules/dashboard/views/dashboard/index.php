<?php
/**
 * @var \humhub\modules\user\models\User $contentContainer
 * @var bool $showProfilePostForm
 */

?>

<?= \humhub\modules\desire\widgets\DesireCloud::widget(); ?>

<div class="page-content">
            <?= \humhub\modules\dashboard\widgets\DashboardContent::widget([
                'contentContainer' => $contentContainer,
                'showProfilePostForm' => $showProfilePostForm
            ])?>
</div>

<?= \humhub\modules\user\widgets\RightSidebar::widget(); ?>

