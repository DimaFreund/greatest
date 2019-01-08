<?php
\humhub\modules\admin\widgets\AdminMenu::markAsActive(['/admin/category']);
?>

<?php $this->beginContent('@admin/views/layouts/main.php') ?>
<div class="panel panel-default">
    <div class="panel-heading">
		<?= Yii::t('AdminModule.user', '<strong>Category</strong>'); ?>
    </div>

	<?= \humhub\modules\admin\widgets\CategoryMenu::widget(); ?>
    <div class="panel-body">
	<?= $content; ?>
    </div>
</div>
<?php $this->endContent(); ?>