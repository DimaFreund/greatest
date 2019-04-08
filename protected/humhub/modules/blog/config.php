<?php

use humhub\commands\IntegrityController;
use humhub\modules\blog\Events;
use humhub\widgets\TopMenu;

return [
    'id' => 'blog',
    'class' => \humhub\modules\blog\Module::className(),
    'isCoreModule' => true,
    'events' => [
        [IntegrityController::className(), IntegrityController::EVENT_ON_RUN, [Events::className(), 'onIntegrityCheck']],
	    ['class' => TopMenu::className(), 'event' => TopMenu::EVENT_INIT, 'callback' => ['humhub\modules\blog\Events', 'onTopMenuInit']],
    ]
];
?>