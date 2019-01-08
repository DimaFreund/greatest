<?php
/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2015 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 *
 * @package humhub.modules.gallery.views
 * @since 1.0
 * @author Sebastian Stumpf
 */

use humhub\modules\file\converter\PreviewImage;
use humhub\modules\user\models\User;

?>




<div class="photo-post four-items">

<?php $counter = 0; ?>
<?php foreach($photos as $photo) { ?>

	<?php
	$photoPreview = new PreviewImage;

	if($counter === 0) {
		$photoPreview->options = [
			'mode'   => 'force',
			'width'  => 520,
			'height' => 360,
		];
	} else {
		$photoPreview->options = [
			'mode'   => 'force',
			'width'  => 175,
			'height' => 121,
		];
	}
	$photoPreview->applyFile($photo->baseFile);

	?>
	<?php $user = User::findOne($photo->content->created_by); ?>
    <div class="item"><a href="<?= $user->createUrl('/user/profile/photo-one', ['id' => $photo->id]); ?>"><img src="<?= $photoPreview->getUrl(); ?>"></a>
    <?php if($counter === 3) { ?>
        <a href="<?= $user->createUrl('/user/profile/photos', ['id' => $photo->gallery_id]); ?>">
            <div class="show-more"><span>+<?= count($photos)-3; ?></span></div>
        </a>
    <?php } ?>
    </div>
    <?php if($counter === 3) break; ?>

<?php
	$counter++;
} ?>
</div>