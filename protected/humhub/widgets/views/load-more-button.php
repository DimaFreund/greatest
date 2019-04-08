<?php
/**
 * Created by PhpStorm.
 * User: work
 * Date: 18.06.18
 * Time: 16:23
 */

use yii\helpers\Url;

?>

<?php if($count > count($object)) { ?>
	<div class="base-btn"><a data-offset="<?= count($object); ?>" id="load-more-button"><?= Yii::t('base','Load more'); ?></a></div>
<?php } ?>


<script>
    $('#load-more-button').on('click', function(){
        var countAllFriends = <?= $count; ?>;
        var currentElement = this;
        var url = '<?php echo Url::to([$ajaxUrl]); ?>';
        var offset = $(this).attr('data-offset');
        var id = '';
        <?php if($userID) { ?>
            id += '&id=' + <?= $userID; ?>;
        <?php } ?>
        $.ajax({
            'type': 'GET',
            'url': url + '&' + 'offset=' + offset + id,
            'cache': false,
            'success': function (result) {
                $('#list-object').append(result.html);
                $(currentElement).attr('data-offset', parseInt(offset) + parseInt(result.count));
                if(parseInt(offset) + parseInt(result.count) >= countAllFriends) {
                    $(currentElement).remove();
                }
            }});
        return false;
    })

</script>
