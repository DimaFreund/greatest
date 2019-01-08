<?php


use yii\helpers\Html;

\humhub\modules\polls\assets\PollsAsset::register($this);
\humhub\modules\content\assets\ContentFormAsset::register($this);

$this->registerJsConfig('content.form', [
	'defaultVisibility' => false,
	'disabled' => ($contentContainer instanceof Space && $contentContainer->isArchived()),
	'text' => [
		'makePrivate' => Yii::t('ContentModule.widgets_views_contentForm', 'Make private'),
		'makePublic' => Yii::t('ContentModule.widgets_views_contentForm', 'Make public'),
		'info.archived' => Yii::t('ContentModule.widgets_views_contentForm', 'This space is archived.')
	]]);

?>

<div class="page-content">
    <div class="content-wrap">
        <div class="create-blog create-poll">
            <h2>Create poll</h2>

        <?php
        if(isset($errors) && !empty($error)) {
	        foreach ( $errors as $error ) { ?>
                <div class="alert alert-danger" role="alert">
			        <?= $error[0]; ?>
                </div>
	        <?php }
        } ?>
		<?= Html::beginForm($submitUrl, 'POST'); ?>

		<?= \humhub\widgets\RichtextField::widget([
			'name' => 'question',
			'placeholder' => Yii::t('PollsModule.widgets_views_pollForm', "Ask something..."),
            'id' => 'pollForm_message',
		]); ?>

            <script>
                $(document).ready(function() {
                    $("#pollForm_message").emojioneArea({
                    });
                });
            </script>

		<div class="contentForm_options" data-content-component="polls.Poll">
			<?= humhub\modules\polls\widgets\AddAnswerInput::widget(['name' => 'newAnswers[]', 'showTitle' => false]); ?>

			<?= Html::dropDownList( 'category', 'null', $category,[
				'class' => 'sm-item form-item',
			]); ?>

            <div class="checkbox">
				<label>
					<?= Html::checkbox("allowMultiple", "", ['id' => "contentForm_allowMultiple", 'class' => 'checkbox contentForm', "tabindex" => "4"]); ?> <?= Yii::t('PollsModule.widgets_views_pollForm', 'Allow multiple answers per user?'); ?>
				</label>
			</div>
			<div class="checkbox">
				<label>
					<?= Html::checkbox("is_random", "", ['id' => "contentForm_is_random", 'class' => 'checkbox contentForm', "tabindex" => "6"]); ?> <?= Yii::t('PollsModule.widgets_views_pollForm', 'Display answers in random order?'); ?>
				</label>
			</div>
			<div class="checkbox">
				<label>
					<?= Html::checkbox("anonymous", "", ['id' => "contentForm_anonymous", 'class' => 'checkbox contentForm', "tabindex" => "5"]); ?> <?= Yii::t('PollsModule.widgets_views_pollForm', 'Anonymous Votes?'); ?>
				</label>
			</div>
		</div>

		<?= Html::hiddenInput("containerGuid", $contentContainer->guid); ?>
		<?= Html::hiddenInput("containerClass", get_class($contentContainer)); ?>

		<ul id="contentFormError"></ul>

            <div class="form-group">
                <div class="base-btn reverse">
			        <?= Html::submitButton( 'Create' ) ?>
                </div>
            </div>
		<?php echo Html::endForm(); ?>
        </div>
	</div>
</div>
