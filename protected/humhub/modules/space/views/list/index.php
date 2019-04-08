<?php
/**
 * Created by PhpStorm.
 * User: work
 * Date: 23.06.18
 * Time: 10:53
 */
?>

<div class="page-content">
	<div class="content-wrap">
		<div class="groups-page">
			<div class="groups-page-header">
				<div class="title"><?= Yii::t('base','Groups'); ?></div>
				<div class="stat"><?= $count; ?> <?= Yii::t('base','Groups'); ?></div>
                <div class="filters">
				<?= \humhub\modules\content\widgets\CategorySelectFilter::widget(['model' => Yii::$app->controller->module->id]); ?>
				<?= \humhub\modules\content\widgets\PageSortFilter::widget(['models' => $spaces]); ?>
                </div>
            </div>
			<ul class="groups-list" id="list-object">
                <?= $this->render('_list', [
                        'spaces' => $spaces,
                        'category' => $category,
                ]); ?>

			</ul>

		</div>
	</div>
    <?= \humhub\widgets\LoadMoreButton::widget(['object' => $spaces, 'count' => $count, 'ajaxUrl' => $ajaxUrl]); ?>

</div>
