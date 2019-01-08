<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2015 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\gallery;

use humhub\modules\gallery\widgets\GallerySnippet;
use \Yii;
use \yii\base\Object;

/**
 * The event handler for the gallery module.
 *
 * @package humhub.modules.gallery
 * @since 1.0
 * @author Sebastian Stumpf
 */
class Events extends Object
{

    public static function onSpaceMenuInit($event)
    {
        if ($event->sender->space !== null && $event->sender->space->isModuleEnabled('gallery')) {
            $event->sender->addItem([
                'label' => Yii::t('GalleryModule.base', 'Photos'),
                'group' => 'modules',
                'url' => $event->sender->space->createUrl('/gallery/list'),
                'icon' => '<i class="fa fa-picture-o"></i>',
                'isActive' => (Yii::$app->controller->module && Yii::$app->controller->module->id == 'gallery' || Yii::$app->controller->module->id == 'user')

            ]);
        }
    }


    public static function onProfileMenuInit($event)
    {
        if ($event->sender->user !== null && $event->sender->user->isModuleEnabled('gallery')) {
            $event->sender->addItem([
                'label' => Yii::t('GalleryModule.base', 'Photos'),
                'url' => $event->sender->user->createUrl('/gallery/list'),
                'sortOrder' => 700,
                'isActive' => (Yii::$app->controller->module && Yii::$app->controller->module->id == 'gallery')
            ]);
        }
    }

    public static function onSpaceSidebarInit($event)
    {
        if ($event->sender->space !== null && $event->sender->space->isModuleEnabled('gallery')) {
            $event->sender->addWidget(GallerySnippet::class, ['contentContainer' => $event->sender->space], ['sortOrder' => 0]);
        }
    }
}
