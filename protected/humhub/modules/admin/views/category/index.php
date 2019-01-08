<?php

use humhub\libs\Html;
use humhub\modules\admin\widgets\LanguageCategoryMenu;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

?>

<?php echo LanguageCategoryMenu::widget(); ?>

<?php $increment = 1; ?>

<ul>
	<?php $form = ActiveForm::begin(); ?>
    <?php foreach ( $category as $item ) { ?>

        <li data-id="<?php echo $item->id; ?>"><?php echo $increment.'.'. $item->default_language; ?>
        <?php if(!$isDefaultLanguage) { ?>
            ---
        <?php echo $item->name; ?></li>
        <?php } else { ?>
            <a href="<?php echo Url::toRoute(['delete', 'id' => $item->id]); ?>">x</a>
            <?php } ?>
    <?php $increment++; } ?>

        <?php if($isDefaultLanguage) { ?>
        <?= $form->field($model, 'name')->textInput(); ?>
        <?php } ?>
        <div class="form-group">
    		<?= Html::submitButton($model->isNewRecord ? 'Save' : 'Save', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

	<?php ActiveForm::end(); ?>

</ul>