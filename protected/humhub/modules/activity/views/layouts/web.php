<?= \humhub\modules\activity\widgets\WallEntry::widget([
	'contentObject' => $record,
	'contentInner' => $content,
	'userAction' => isset($viewable->userAction)?$viewable->userAction:'',
	'objectName' => method_exists($viewable,'getName')?$viewable->getName():'',
	]); ?>

