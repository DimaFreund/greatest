<?php
/**
 * Created by PhpStorm.
 * User: work
 * Date: 09.02.18
 * Time: 11:12
 */

use yii\helpers\Url;

?>
<section class="singlestory-sec1">
		<div class="container">
			<div class="row">
				<div class="col-lg-11 col-lg-offset-1">
					<p class="singlestory-title kaushan">My Success Story</p>
					<p class="singlestory-about"><?= $model->title; ?></p>
					<p class="singlestory-date"><?= $model->date; ?></p>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-8">
					<?= $model->content; ?>
				</div>
				<div class="col-lg-4">
					<div class="singlestory_pic">
						<img src="/uploads/admin_files/<?php echo $model->image; ?>">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="singlestory_button">
						<a class="green_button" href="<?= Url::toRoute(['index']); ?>">Back to list</a>
					</div>
				</div>
			</div>
		</div>
	</section>
