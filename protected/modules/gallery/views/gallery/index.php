<?php
/**
 * Created by PhpStorm.
 * User: work
 * Date: 22.06.18
 * Time: 13:44
 */

use humhub\modules\user\models\User;
use yii\helpers\Url;

?>



<div class="page-content">
    <div class="content-wrap">
        <div class="photos-page">
            <div class="photos-page-header">
                <div class="title">Photos</div>
                <div class="subtitle">Public Photos</div>
<!--	            --><?//= \humhub\modules\content\widgets\PageSortFilter::widget(); ?>
            </div>
            <div class="albums-img-layout" id="list-object">
                    <?= $this->render('_one-photo',[
                            'photos' => $photos,
                    ]) ?>
            </div>
        </div>
    </div>

    <?= \humhub\widgets\LoadMoreButton::widget(['object' => $photos, 'count' => $countPhotos, 'ajaxUrl' => $ajaxUrl]); ?>
    <div class="content-wrap">
        <div class="photos-page">
            <div class="photos-page-header">
                <div class="subtitle">Public Albums</div>
	            <?= \humhub\modules\content\widgets\PageSortFilter::widget(['models' => $albums]); ?>
            </div>
            <div class="albums-layout" id="list-albums">
                <?= $this->render('_one-albums', [
                        'albums' => $albums,
                        'category' => $category,
                ]); ?>
            </div>
        </div>
    </div>
	<?php if($countAlbums > count($albums)) { ?>
        <div class="base-btn"><a data-offset-albums="<?= count($albums); ?>" id="load-more-button-albums">Load more</a></div>
	<?php } ?>


    <script>
        $('#load-more-button-albums').on('click', function(){
            var countAllFriends = <?= $countAlbums; ?>;
            var currentElement = this;
            var url = '<?php echo Url::to([$ajaxUrlAlbums]); ?>';
            var offset = $(this).attr('data-offset-albums');
            $.ajax({
                'type': 'GET',
                'url': url + '&' + 'offset=' + offset,
                'cache': false,
                'success': function (result) {
                    $('#list-albums').append(result.html);
                    $(currentElement).attr('data-offset-albums', parseInt(offset) + parseInt(result.count));
                    if(parseInt(offset) + parseInt(result.count) >= countAllFriends) {
                        $(currentElement).remove();
                    }
                }});
            return false;
        })

    </script>
</div>
