<?php

use humhub\components\ActiveRecord;
use humhub\commands\IntegrityController;
use humhub\modules\like\Module;
use humhub\modules\user\models\User;
use humhub\modules\content\widgets\WallEntryLinks;

return [
	'id' => 'tags',
	'class' => humhub\modules\like\Module::className(),
];
?>