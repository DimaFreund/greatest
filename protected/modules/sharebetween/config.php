<?php

use humhub\modules\content\widgets\WallEntryControls;
use humhub\modules\content\components\ContentActiveRecord;

return [
    'id' => 'sharebetween',
    'class' => 'humhub\modules\sharebetween\Module',
    'namespace' => 'humhub\modules\sharebetween',
    'events' => [
        ['class' => ContentActiveRecord::className(), 'event' => ContentActiveRecord::EVENT_BEFORE_DELETE, 'callback' => ['humhub\modules\sharebetween\Events', 'onContentDelete']],
    ],
];
