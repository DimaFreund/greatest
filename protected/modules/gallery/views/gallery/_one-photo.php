<?php
/**
 * Created by PhpStorm.
 * User: work
 * Date: 23.06.18
 * Time: 16:03
 */

use humhub\modules\file\converter\PreviewImage;
use humhub\modules\user\models\User;

?>
<?php $counter = 1; ?>
<?php foreach($photos as $photo) { ?>

    <?php
	$photoPreview = new PreviewImage;

    if($counter === 1) {
	    $photoPreview->options = [
		    'mode'   => 'force',
		    'width'  => 501,
		    'height' => 341,
	    ];
    } else {
	    $photoPreview->options = [
		    'mode'   => 'force',
		    'width'  => 251,
		    'height' => 171,
	    ];
    }
	$photoPreview->applyFile($photo);
    $counter++;
    ?>
    <?php $user = User::findOne($photo->created_by); ?>
	<div class="item"><a href="<?= $user->createUrl('/user/profile/photo-one', ['id' => $photo->object_id]); ?>"><img src="<?= $photoPreview->getUrl(); ?>"></a></div>


<?php } ?>
