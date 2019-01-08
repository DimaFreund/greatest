<?php

use humhub\commands\IntegrityController;
use humhub\modules\desire\Events;
use humhub\widgets\TopMenu;

return [
    'id' => 'desire',
    'class' => \humhub\modules\desire\Module::className(),
    'isCoreModule' => true,
    'events' => [
        [IntegrityController::className(), IntegrityController::EVENT_ON_RUN, [Events::className(), 'onIntegrityCheck']],
	    ['class' => TopMenu::className(), 'event' => TopMenu::EVENT_INIT, 'callback' => ['humhub\modules\desire\Events', 'onTopMenuInit']],
    ]
];
?>