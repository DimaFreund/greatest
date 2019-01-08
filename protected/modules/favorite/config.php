<?php

use humhub\components\ActiveRecord;
use humhub\commands\IntegrityController;
use humhub\modules\favorite\Module;
use humhub\modules\user\models\User;
use humhub\modules\content\widgets\WallEntryLinks;

return [
	'id' => 'favorite',
	'class' => 'humhub\modules\favorite\Module',
	'namespace' => 'humhub\modules\favorite',
	'events' => array(
		array('class' => User::className(), 'event' => User::EVENT_BEFORE_DELETE, 'callback' => array('humhub\modules\favorite\Events', 'onUserDelete')),
		array('class' => ActiveRecord::className(), 'event' => ActiveRecord::EVENT_BEFORE_DELETE, 'callback' => array('humhub\modules\favorite\Events', 'onActiveRecordDelete')),
		array('class' => IntegrityController::className(), 'event' => IntegrityController::EVENT_ON_RUN, 'callback' => array('humhub\modules\favorite\Events', 'onIntegrityCheck')),
	),
];
?>