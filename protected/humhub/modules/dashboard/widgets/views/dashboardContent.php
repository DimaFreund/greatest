<?php

use humhub\modules\stream\widgets\StreamViewer;

?>

<?php echo \humhub\modules\post\widgets\Form::widget( [ 'contentContainer' => $contentContainer ] ); ?>


<div class="content-wrap">

	<?php echo StreamViewer::widget( [
		'streamAction'       => '//dashboard/dashboard/stream',
		'showFilters'        => false,
		'messageStreamEmpty' => $messageStreamEmpty
	] ); ?>
</div>

