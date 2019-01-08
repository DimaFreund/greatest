<?php
\humhub\modules\admin\widgets\AdminMenu::markAsActive(['/admin/news']);
?>

<?php $this->beginContent('@admin/views/layouts/main.php') ?>
<div class="panel panel-default">
	<div class="panel-heading">
		<?= Yii::t('AdminModule.user', '<strong>News</strong>'); ?>
	</div>
	<!--        --><?//= \humhub\modules\admin\widgets\BlogMenu::widget(); ?>
	<div class="panel-body">
		<?= $content; ?>
	</div>
</div>
<?php $this->endContent(); ?>
<?php $this->registerJsFile('/ckeditor/ckeditor.js'); ?>
<?php $this->registerJsFile('/ckfinder/ckfinder.js'); ?>
<script>
    $(document).ready(function(){
        var editor = CKEDITOR.replaceAll();
        CKFinder.setupCKEditor(editor);
    })
</script>
