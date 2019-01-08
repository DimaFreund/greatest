<?php
/**
 * Created by PhpStorm.
 * User: work
 * Date: 14.05.18
 * Time: 12:02
 */


?>

<?php if(!$mode) { ?>
<div class="rating">
    <div data-rating="<?= $currentUserVoice; ?>" data-id-desire="<?= $object->id; ?>" class="active-star-rating"></div>
    <div class="text">Rate</div>
</div>
<?php } else { ?>
<?= \humhub\modules\rating\widgets\RatingDisplay::widget(['object' => $object]); ?>
<?php } ?>