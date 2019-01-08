<?php

?>

<div class="page-filter">
	<?= \yii\helpers\Html::dropDownList('sort', $currentSort, $sortParameters, ['onchange' => "location = '$baseUrl&sort=' + this.value;"]); ?>
</div>
