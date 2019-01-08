<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use humhub\modules\search\models\forms\SearchForm;
use humhub\modules\content\components\ContentActiveRecord;
use humhub\modules\content\components\ContentContainerActiveRecord;

humhub\modules\stream\assets\StreamAsset::register($this);

?>

<div class="page-content" data-action-component="stream.SimpleStream">
    <div class="content-wrap">
        <div class="general-search">
            <div class="search-header">
                <div class="title">Your search</div>
                <div class="search-form">
	                <?php $form = ActiveForm::begin(['action' => Url::to(['index']), 'method' => 'GET', 'fieldConfig' => [
		                'options' => [
			                'tag' => false,
		                ],
	                ],]); ?>
                    <div class="wrap">
	                    <?= $form->field($model, 'keyword', ['errorOptions' => ['tag' => null]])->textInput([
		                    'placeholder' => Yii::t('SearchModule.views_search_index', 'Search for user, spaces and content'),
		                    'title' => Yii::t('SearchModule.views_search_index', 'Search for user, spaces and content'),
		                    'id' => 'search-input-field',
	                    ])->label(false); ?>
                        <input type="submit">
                    </div>
	                <?php if ($model->keyword != "") { ?>
                    <div class="filters">
                        <div class="filter-title">Search in categories:</div>
                        <div class="category"><input <?php if(array_key_exists(SearchForm::SCOPE_DESIRE , $model->scope)) echo 'checked'; ?> name="scope[<?= SearchForm::SCOPE_DESIRE ; ?>]" type="checkbox" id="1"><label for="1">Desires</label></div>
                        <div class="category"><input <?php if(array_key_exists(SearchForm::SCOPE_BLOG , $model->scope)) echo 'checked'; ?> name="scope[<?= SearchForm::SCOPE_BLOG ; ?>]" type="checkbox" id="2"><label for="2">Blogs</label></div>
                        <div class="category"><input <?php if(array_key_exists(SearchForm::SCOPE_NEWS , $model->scope)) echo 'checked'; ?> name="scope[<?= SearchForm::SCOPE_NEWS ; ?>]" type="checkbox" id="3"><label for="3">News</label></div>
                        <div class="category"><input <?php if(array_key_exists(SearchForm::SCOPE_POLL , $model->scope)) echo 'checked'; ?> name="scope[<?= SearchForm::SCOPE_POLL ; ?>]" type="checkbox" id="5"><label for="5">Polls</label></div>
                        <div class="category"><input <?php if(array_key_exists(SearchForm::SCOPE_SPACE , $model->scope)) echo 'checked'; ?> name="scope[<?= SearchForm::SCOPE_SPACE ; ?>]" type="checkbox" id="6"><label for="6">Groups</label></div>
                        <div class="category"><input <?php if(array_key_exists(SearchForm::SCOPE_USER , $model->scope)) echo 'checked'; ?> name="scope[<?= SearchForm::SCOPE_USER ; ?>]" type="checkbox" id="7"><label for="7">User</label></div>
                        <div class="category"><input <?php if(array_key_exists(SearchForm::SCOPE_POST , $model->scope)) echo 'checked'; ?> name="scope[<?= SearchForm::SCOPE_POST; ?>]" type="checkbox" id="7"><label for="7">Post</label></div>
                    </div>
                    <?php } ?>

                    <div class="text-center">
                        <a data-toggle="collapse" id="search-settings-link" href="#collapse-search-settings"
                           style="font-size: 11px;"><i
                                    class="fa fa-caret-right"></i> <?php echo Yii::t('SearchModule.views_search_index', 'Advanced search settings'); ?>
                        </a>
                    </div>

                    <div id="collapse-search-settings" class="panel-collapse collapse">
                        <br>
		                <?=  Yii::t('SearchModule.views_search_index', 'Search only in certain spaces:'); ?>
		                <?= \humhub\modules\space\widgets\SpacePickerField::widget([
			                'id' => 'space_filter',
			                'model' => $model,
			                'attribute' => 'limitSpaceGuids',
			                'selection' => $limitSpaces,
			                'placeholder' => Yii::t('SearchModule.views_search_index', 'Specify space')
		                ]) ?>
                    </div>
                    <br>
	                <?php ActiveForm::end(); ?>
                </div>
            </div>
            <div class="general-search-result">
	            <?php if ($model->keyword != "") { ?>
                <div class="searchResults">

		            <?php if (count($results) > 0): ?>
                    <ul class="search-result">
			            <?php foreach ($results as $result): ?>
				            <?php if ($result instanceof ContentActiveRecord) : ?>
					            <?= humhub\modules\stream\actions\Stream::renderEntry($result) ?>
				            <?php elseif ($result instanceof ContentContainerActiveRecord) : ?>
					            <?= $result->getWallOut(); ?>
				            <?php else: ?>
                                No Output for Class <?php echo get_class($result); ?>
				            <?php endif; ?>
			            <?php endforeach; ?>
                    </ul>
		            <?php else: ?>


                        <div class="panel panel-default">
                            <div class="panel-body">
                                <p><strong><?php echo Yii::t('SearchModule.views_search_index', 'Your search returned no matches.'); ?></strong></p>
                            </div>
                        </div>
		            <?php endif; ?>
                </div>

                <div
                        class="pagination-container"><?php echo humhub\widgets\LinkPager::widget(['pagination' => $pagination]); ?>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">

    $(document).ready(function () {
        // set focus to input for seach field
        $('#search-input-field').focus();
    });


    $('#collapse-search-settings').on('show.bs.collapse', function () {
        // change link arrow
        $('#search-settings-link i').removeClass('fa-caret-right');
        $('#search-settings-link i').addClass('fa-caret-down');
    });

    $('#collapse-search-settings').on('shown.bs.collapse', function () {
        $('#space_input_field').focus();
    })

    $('#collapse-search-settings').on('hide.bs.collapse', function () {
        // change link arrow
        $('#search-settings-link i').removeClass('fa-caret-down');
        $('#search-settings-link i').addClass('fa-caret-right');
    });


<?php foreach (explode(" ", $model->keyword) as $k) : ?>
        $(".searchResults").highlight("<?php echo Html::encode($k); ?>");
        $(document).ajaxComplete(function (event, xhr, settings) {
            $(".searchResults").highlight("<?php echo Html::encode($k); ?>");
        });
<?php endforeach; ?>
</script>

