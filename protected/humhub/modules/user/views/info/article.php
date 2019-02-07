<?php
/**
 * Created by PhpStorm.
 * User: work
 * Date: 09.02.18
 * Time: 11:12
 */

use yii\helpers\Url;

?>

<section class="single-success-stories">
    <div class="base-wrap">
        <div class="single-top-title">My Success Storie</div>
        <h1 class="base-lg-title"><?= $model->title; ?></h1>
        <div class="date"><?= $model->date; ?></div>
    </div>
    <div class="base-wrap">
        <div class="single-story-text">
            <div class="text-block">
               <?= $model->content; ?>
            </div>
            <div class="img-block">
                <img src="/uploads/admin_files/<?php echo $model->image; ?>">
            </div>
        </div>
        <div class="base-btn"><a href="<?= Url::toRoute(['index']); ?>">Back to list</a></div>
    </div>
</section>
