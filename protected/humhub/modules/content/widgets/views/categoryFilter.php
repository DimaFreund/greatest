<?php
/**
 * Created by PhpStorm.
 * User: work
 * Date: 06.09.18
 * Time: 11:13
 */

use humhub\widgets\ActiveForm;
use yii\bootstrap\Html;
use yii\helpers\Url;


?>

<div class="sidebar-categories">
	<div class="title">Categories</div>
	    <?php $form = ActiveForm::begin(['action' => Url::toRoute(''), 'method' => 'GET', 'fieldConfig' => [
		    'options' => [
			    'tag' => false,
		    ],
	    ],]); ?>
            <?= $form->field($model, 'filter')->checkboxList($category,[
	            'tag' => false,
	            'item' => function ($index, $label, $name, $checked, $value) {
                $checked?$active = 'active':$active = '';
		            return '<div class="category '.$active.'">'.Html::checkbox($name, $checked, ['value' => $value, 'onchange' => 'return form.submit();', 'id' => 'category-filter-id-'.$index]) .
		                   '<label for="category-filter-id-'.$index.'">' . $label . '</label></div>';
	            },
                    'options' => [
                        'onchange' => 'return form.submit()',
                    ]
            ])->label(false); ?>
<!--            <input onchange="return form.submit();" type="checkbox" name="filter" value="--><?//= $key; ?><!--" id="category-filter-id---><?//= $key; ?><!--">-->
<!--            <label for="category-filter-id---><?//= $key; ?><!--">--><?//= $item; ?><!--</label>-->

    <?php ActiveForm::end(); ?>
</div>
