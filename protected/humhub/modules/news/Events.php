<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2017 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\news;

use Yii;
use humhub\modules\news\models\News;
use yii\helpers\Url;

/**
 * Event callbacks for the news module
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

        $integrityController->showTestHeadline("News  Module - News (" . News::find()->count() . " entries)");
        foreach (News::find()->all() as $news) {
            if (empty($news->content->id)) {
                if ($integrityController->showFix("Deleting news " . $news->id . " without existing content record!")) {
                    $news->delete();
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
			'label' => Yii::t('NewsModule.base', 'News create'),
			'url' => Url::to(['/news/news/create']),
			'icon' => '<i class="fa fa-plus"></i>',
			'isActive' => (Yii::$app->controller->module && Yii::$app->controller->module->id == 'news' && Yii::$app->controller->action->id == 'create'),
			'sortOrder' => 900,
		));

		$event->sender->addItem(array(
			'label' => Yii::t('NewsModule.base', 'News list'),
			'url' => Url::to(['/news/news/list']),
			'icon' => '<i class="fa fa-list"></i>',
			'isActive' => (Yii::$app->controller->module && Yii::$app->controller->module->id == 'news' && Yii::$app->controller->action->id == 'list'),
			'sortOrder' => 1000,
		));

	}

}
