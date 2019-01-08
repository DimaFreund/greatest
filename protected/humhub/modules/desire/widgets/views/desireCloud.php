<?php
/**
 * Created by PhpStorm.
 * User: work
 * Date: 16.08.18
 * Time: 14:39
 */

use humhub\modules\content\widgets\BottomPanelContent;
use humhub\widgets\ActiveForm;
use yii\helpers\Url;

?>

<div class="desires-cloud main-network-page">
	<div class="random-desires">
        <?php foreach($desires as $desire) { ?>
		<div class="random-desire">
			<div class="desire-img">
				<?= \humhub\modules\file\widgets\ShowPhotoPreview::widget( [
					'object'  => $desire,
					'options' => [
						'index'  => 0,
						'height' => 170,
						'width'  => 170,
					]
				] ); ?>
            </div>
			<div class="info-short">
				<div class="top">
					<div class="name"><?= $desire->user->displayName; ?></div>
                    <?= \humhub\modules\rating\widgets\RatingDisplay::widget(['object' => $desire]); ?>
				</div>
				<div class="bottom">
					<div class="img-block"><img src="<?= $desire->user->getProfileImage()->getUrl(); ?>"></div>
					<div class="wrap">
						<div class="desire-text">
							<div class="text"><?= $desire->title; ?></div>
						</div>
						<div class="desire-bottom-hover">
                            <?= \humhub\modules\content\widgets\BottomPanelContent::widget(['object' => $desire, 'ratingLink' => true]); ?>
<!--							<div class="comments"><svg class="icon icon-comment_border"><use xlink:href="./svg/sprite/sprite.svg#comment_border"></use></svg><svg class="icon icon-comments"><use xlink:href="./svg/sprite/sprite.svg#comments"></use></svg>-->
<!--								<div-->
<!--									class="text">Comment</div>-->
<!--								<div class="val">(<span>35</span>)</div>-->
<!--							</div>-->
<!--							<div class="rating">-->
<!--								<div class="star-rating"></div>-->
<!--								<div class="text">Rate</div>-->
<!--							</div>-->
<!--							<div class="share"><svg class="icon icon-share"><use xlink:href="./svg/sprite/sprite.svg#share"></use></svg>-->
<!--								<div class="text">Share</div>-->
<!--								<div class="val">(12)</div>-->
<!--							</div>-->
<!--							<div class="stars">-->
<!--								<div class="follow-btn"><svg class="icon icon-star_fill"><use xlink:href="./svg/sprite/sprite.svg#star_fill"></use></svg><svg class="icon icon-star_empty"><use xlink:href="./svg/sprite/sprite.svg#star_empty"></use></svg></div>-->
<!--							</div>-->
						</div>
						<div class="statistic-info">
							<?= BottomPanelContent::widget([
								'object' => $desire,
								'mode' => BottomPanelContent::SMALL_MODE,
								'ratingLink' => true,
								'commentLinkPage' => true,
								'options' => ['commentPageUrl' => '/user/profile/desire-one'],
							]); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
        <?php } ?>
	</div>
	<div class="title">Desire board</div>

		<?php $form = ActiveForm::begin(['action' => Url::to(['/desire/desire/search']), 'method' => 'GET', 'id' => 'search-by-tags', 'options' => ['class' => 'search-tags'], 'fieldConfig' => [
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
            <ul class="tips-field" id="tips-field"></ul>
            <input type="submit" value="Search">
        </div>
		<?php ActiveForm::end(); ?>

</div>


<script>
    var phraseSearch = '';

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
        $.post("<?= Url::to(['/desire/desire/auto-tips']); ?>", {word: keyWord}, function (data) {
            displayTips(data)
        })
    }

    function displayTips(list) {
        var tipsField = $('#tips-field');
        var html = '';
        list.forEach(function (item, key, arr) {
            var element = item.title;
            html += '<li>' + element + '</li>';
        })
        tipsField.html(html);
    }

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

