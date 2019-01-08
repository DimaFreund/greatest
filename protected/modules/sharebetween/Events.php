<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2016 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\sharebetween;

use Yii;

class Events extends \yii\base\Object
{

    public static function onWallEntryControlsInit($event)
    {
        $stackWidget = $event->sender;
        $content = $event->sender->object;

        $stackWidget->addWidget(widgets\ShareLink::className(), ['object' => $content]);
    }

    public static function onContentDelete($event)
    {
        $shares = models\Share::findAll(['content_id' => $event->sender->content->id]);
        foreach ($shares as $share) {
            $share->delete();
        }
    }

}
