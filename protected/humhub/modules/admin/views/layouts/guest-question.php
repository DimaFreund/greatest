<?php
\humhub\modules\admin\widgets\AdminMenu::markAsActive(['/admin/guest-question']);
?>

<?php $this->beginContent('@admin/views/layouts/main.php') ?>
<div class="panel panel-default">
    <div class="panel-body">
	<?= $content; ?>
    </div>
    </div>
<?php $this->endContent(); ?>