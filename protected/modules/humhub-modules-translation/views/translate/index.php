<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;

use humhub\modules\translation\assets\MainAsset;

$bundle = MainAsset::register($this);
?>

<?php $this->registerCss('.loading-indicator {
	height: 80px;
	width: 80px;
    background: url( "'. $bundle->baseUrl .'/img/loading.gif" );
	background-repeat: no-repeat;
	background-position: center center;
}'); ?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><?php echo Yii::t('TranslationModule.views_translate_index', 'Translation Editor'); ?></div>
                <div class="panel-body">

                    <?php Pjax::begin(['id' => 'pjax']); ?>

                    <?php if (Yii::$app->session->hasFlash('success')): ?>
                        <div class="alert alert-success alert-dismissable" id="succesSave">
                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button" timeout="1000">×</button>
                            <h5><i class="icon fa fa-check"></i>  Saved!</h5>
                        </div>
                        <?php $this->registerJs(
                            'setTimeout(function(){
                                    $("#succesSave").hide("slow");
                                }, 1000)') ?>
                    <?php endif; ?>

                    <?= Html::beginForm(Url::to(['/translation/translate']), 'POST', ['data-pjax' => true, 'id' => 'form']); ?>
                    <div class="row">
                        <div class="form-group col-md-4">
<!--                            <label for="">Module</label>-->
                            <?= Html::dropDownList('moduleId', $moduleId, $moduleIds, ['class' => 'hidden form-control', 'onChange' => 'selectOptions()']); ?>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="">Language</label>
                            <?= Html::dropDownList('language', $language, $languages, ['class' => 'form-control', 'onChange' => 'selectOptions()']); ?>
                        </div>
                        <div class="form-group col-md-6">
<!--                            <label for="">File</label>-->
                            <?= Html::dropDownList('file', $file, $files, ['class' => 'hidden form-control', 'onChange' => 'selectOptions()']); ?>
                        </div>

                        <?= Html::input('hidden', 'saveForm', 1)?>

                    </div>
                    <hr>

                    <?php $i = 0; ?>


                    <p style="float: right">
                        <?= Html::textInput("search", null, ["class" => "form-control form-search", "placeholder" => 'Search']); // Yii::t('TranslationModule.views_translate_index', 'Search') ?>
                    </p>

                    <p><?= Html::submitButton(Yii::t('TranslationModule.views_translate_index', 'Save'), ['class' => 'btn btn-primary', 'id' => 'submitPjax']); ?></p>

                    <hr>
                    <div id="words">
                        <div>
                            <div class="elem">Original (en)</div>
                            <div class="elem">Translated (<?php echo $language; ?>)</div>
                        </div>

                        <?php foreach ($messages as $orginal => $translated) : ?>
                            <div class="row ">
                                <?php $i++; ?>
                                <div class="elem">
                                    <div class="pre"><?php print Html::encode($orginal); ?></div>
                                </div>
                                <div class="elem"><?php echo Html::textArea('tid_' . md5($orginal), $translated, array('class' => 'form-control')); ?></div>
                            </div>
                        <?php endforeach; ?>

                    </div>
                    <hr>

                    <p><?= Html::submitButton(Yii::t('TranslationModule.views_translate_index', 'Save'), ['class' => 'btn btn-primary']); ?></p>

                    <?= Html::endForm(); ?>

                    <?php Pjax::end(); ?>

                </div>
            </div>
        </div>
    </div>
</div>
