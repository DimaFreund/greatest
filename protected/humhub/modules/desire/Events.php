<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2017 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\desire;

use Yii;
use humhub\modules\desire\models\Desire;
use yii\helpers\Url;

/**
 * Event callbacks for the desire module
 */
class Events extends \yii\base\Object
{

    /**
     * Callback to validate module database records.
     *
     * @param \yii\base\Event $event
     */
    public static function onIntegrityCheck($event)
    {
        $integrityController = $event->sender;

        $integrityController->showTestHeadline("Desire  Module - Desire (" . Desire::find()->count() . " entries)");
        foreach (Desire::find()->all() as $desire) {
            if (empty($desire->content->id)) {
                if ($integrityController->showFix("Deleting desire " . $desire->id . " without existing content record!")) {
                    $desire->delete();
                }
            }
        }
    }
	public static function onTopMenuInit($event)
	{
		if (Yii::$app->user->isGuest) {
			return;
		}

		$event->sender->addItem(array(
			'label' => Yii::t('DesireModule.base', 'Desire create'),
			'url' => Url::to(['/desire/desire/create']),
			'icon' => '<i class="fa fa-plus"></i>',
			'isActive' => (Yii::$app->controller->module && Yii::$app->controller->module->id == 'desire' && Yii::$app->controller->action->id == 'create'),
			'sortOrder' => 900,
		));

		$event->sender->addItem(array(
			'label' => Yii::t('DesireModule.base', 'Desire list'),
			'url' => Url::to(['/desire/desire/list']),
			'icon' => '<i class="fa fa-list"></i>',
			'isActive' => (Yii::$app->controller->module && Yii::$app->controller->module->id == 'desire' && Yii::$app->controller->action->id == 'list'),
			'sortOrder' => 1000,
		));

	}

}
