<?php

use humhub\commands\IntegrityController;
use humhub\modules\news\Events;
use humhub\widgets\TopMenu;

return [
    'id' => 'news',
    'class' => \humhub\modules\news\Module::className(),
    'isCoreModule' => true,
    'events' => [
        [IntegrityController::className(), IntegrityController::EVENT_ON_RUN, [Events::className(), 'onIntegrityCheck']],
	    ['class' => TopMenu::className(), 'event' => TopMenu::EVENT_INIT, 'callback' => ['humhub\modules\news\Events', 'onTopMenuInit']],
    ]
];
?>