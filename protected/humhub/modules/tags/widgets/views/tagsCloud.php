<?php
/**
 * Created by PhpStorm.
 * User: work
 * Date: 03.09.18
 * Time: 13:37
 */

use humhub\widgets\ActiveForm;
use yii\helpers\Url;

?>


    <div class="title">Popular desire tags</div>
    <div id="all-footer-tags">

	    <?php foreach($tags as $tag) { ?>
            <span data-weight="<?= $tag->weight; ?>"><a href="<?= Url::to(['/desire/desire/search', 'SearchForm[keyword]' => $tag->tags->title]); ?>"><?= $tag->tags->title; ?></a></span>
	    <?php } ?>

    </div>
    <div class="search-tags">
	    <?php $form = ActiveForm::begin(['action' => Url::to(['/desire/desire/search']), 'method' => 'GET', 'id' => 'search-by-tags', 'fieldConfig' => [
		    'options' => [
			    'tag' => false,
		    ],
	    ],]); ?>
        <p>Find your like-minded people</p>
        <div class="form-wrap">
		    <?= $form->field($model, 'keyword', ['errorOptions' => ['tag' => null]])->textInput([
			    'placeholder' => 'Desire keywords',
			    'title' => 'Desire keywords',
			    'class' => false,
			    'id' => 'search-input-field',
			    'onkeypress' => 'return generateTips(event)',
			    'autocomplete' => 'off',
		    ])->label(false); ?>
            <input type="submit" value="Search">
        </div>
	    <?php ActiveForm::end(); ?>
    </div>

