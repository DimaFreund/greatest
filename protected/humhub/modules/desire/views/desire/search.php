<?php
/**
 * Created by PhpStorm.
 * User: work
 * Date: 29.08.18
 * Time: 12:47
 */

use humhub\widgets\ActiveForm;
use yii\bootstrap\Html;
use yii\helpers\Url;

?>

<div class="desires-cloud">
	<div class="search-tags">
		<p>Find your like-minded people</p>
		<div class="form-wrap">
			<?php $form = ActiveForm::begin(['action' => Url::to(['search']), 'method' => 'GET', 'id' => 'search-by-tags', 'fieldConfig' => [
				'options' => [
					'tag' => false,
				],
			],]); ?>
			<?= $form->field($model, 'keyword', ['errorOptions' => ['tag' => null]])->textInput([
				'placeholder' => 'Desire keywords',
				'title' => 'Desire keywords',
				'id' => 'search-input-field',
				'onkeypress' => 'return generateTips(event)',
                'autocomplete' => 'off',
			])->label(false); ?>
            <ul class="tips-field" id="tips-field"></ul>
            <input type="submit" value="Search">

		<?php ActiveForm::end(); ?>
        </div>
	</div>
</div>
<div class="page-content">
	<!--.desire-tags-search-->
	<!--  .title Your search-->
	<!--  input#tags(type="text")-->
	<div class="desire-search-header">
		<div class="stat"><?= count($resultSearch); ?> matches</div>
		<div class="map-btn"><svg class="icon icon-location"><use xlink:href="./svg/sprite/sprite.svg#location"></use></svg>view on map</div>
		<div class="map-block"><iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d81217.46868235002!2d30.48229395!3d50.49610355!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sru!2sua!4v1526995954734" width="600" height="350" frameborder="0"
		                               style="border:0" allowfullscreen></iframe></div>
	</div>
	<div class="content-wrap grey">
		<div class="all-desires desire-search-result">
            <?php if(!empty($resultSearch) && is_array($resultSearch)) { ?>
                <?php foreach($resultSearch as $article) { ?>
			    <?= $this->render('_item', [
			            'article' => $article,
                ]); ?>
                <?php } ?>
            <?php } else { ?>
            <div class="desire">
                <div class="info-short">
            <p>Nothing found</p>
                </div>
            </div>
            <?php } ?>
		</div>
	</div>
</div>
<aside class="right-side">
	<div class="right-sidebar">
		<div class="sidebar-search-filter">
			<div class="title">Browse</div>
			<div class="gender">
				<div class="label">Gender</div>
				<div class="wrap radio-btn-wrap">
                    <?= $form->field($model, 'gender')
                             ->radioList(\humhub\modules\user\models\Profile::getOptionsField('gender'),
		                    [
			                    'tag' => false,
			                    'item' => function ($index, $label, $name, $checked, $value) {
				                    return '<div>'.Html::checkbox($name, $checked, ['value' => $value, 'form' => 'search-by-tags', 'id' => 'radio7-'.$index]) .
				                           '<label for="radio7-'.$index.'">' . $label . '</label></div>';
			                    },
		                    ]
                            )->label(false); ?>
				</div>
			</div>
			<div class="age">
				<div class="label">Age</div>
				<div class="wrap">
                    <span>from</span>
                    <?= $form->field($model, 'age_from')->input('number',['form' => 'search-by-tags', 'class' => false])->label(false); ?>
<!--                    <input form="search-by-tags" type="number" name="options[age][from]">-->
                    <span>
                        to
	                    <?= $form->field($model, 'age_to')->input('number',['form' => 'search-by-tags', 'class' => false])->label(false); ?>
                    </span>
                </div>
			</div>
			<div class="location">
				<div class="label">Location</div>
				<?= $form->field($model, 'country')->textInput([
					'placeholder' => 'Start typing country',
					'title' => 'Start typing country',
					'id' => 'country-input-field',
					'onkeypress' => 'return generateTipsCountry(event)',
					'autocomplete' => 'off',
                    'form' => 'search-by-tags',
				])->label(false); ?>
                <ul class="tips-field-country" id="tips-field-country"></ul>
            </div>
		</div>

		<?= \humhub\modules\user\widgets\RightSidebar::widget(); ?>
	</div>
</aside>


<script>
    var phraseSearch = '';

    function generateTipsCountry(event) {
        keyWord = event.target.value + event.key;
        if(keyWord.length > 0) {
            $.post("<?= Url::to(['auto-tips-country']); ?>", {word: keyWord}, function (list) {
                var tipsField = $('#tips-field-country');
                var html = '';
                $.each(list, function(key, value) {
                    html += '<li>' + value + '</li>';
                });
                tipsField.html(html);
            })
        }
    }

    function generateTips(event) {
        phraseSearch = event.target.value + event.key;
        var lastSeparator = phraseSearch.lastIndexOf(',');
        var keyWord = phraseSearch.substring(lastSeparator+1);
        keyWord = keyWord.replace(', ', '');
        keyWord = keyWord.replace(',', '');
        keyWord = keyWord.replace(' ', '');
        if(keyWord.length > 1) {
            autocompliteSearch(keyWord);
        }
    }
    function autocompliteSearch(keyWord) {
        $.post("<?= Url::to(['auto-tips']); ?>", {word: keyWord}, function (data) {
            displayTips(data)
        })
    }

    function displayTips(list) {
        var tipsField = $('#tips-field');
        var html = '';
        list.forEach(function (item, key, arr) {
            var element = item.title;
            html += '<li>' + element + '</li>';
        });
        tipsField.html(html);
    }

    $('#search-input-field').focus();

    $('#tips-field').on('click', 'li', function () {
        var word = $(this).html();
        var lastSeparator = phraseSearch.lastIndexOf(',');
        if(lastSeparator === -1) lastSeparator = -2;
        var keyPhrase = phraseSearch.substring(0, lastSeparator+2);

        $('#search-input-field').val(keyPhrase + word + ', ').focus();
        $(this).parent().html('');

    });
    $('#tips-field-country').on('click', 'li', function () {
        var word = $(this).html();

        $('#country-input-field').val(word).focus();
        $(this).parent().html('');

    })

</script>
