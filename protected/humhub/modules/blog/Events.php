<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2017 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\blog;

use Yii;
use humhub\modules\blog\models\Blog;
use yii\helpers\Url;

/**
 * Event callbacks for the blog module
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

        $integrityController->showTestHeadline("Blog  Module - Blog (" . Blog::find()->count() . " entries)");
        foreach (Blog::find()->all() as $blog) {
            if (empty($blog->content->id)) {
                if ($integrityController->showFix("Deleting blog " . $blog->id . " without existing content record!")) {
                    $blog->delete();
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
			'label' => Yii::t('BlogModule.base', 'Blog create'),
			'url' => Url::to(['/blog/blog/create']),
			'icon' => '<i class="fa fa-plus"></i>',
			'isActive' => (Yii::$app->controller->module && Yii::$app->controller->module->id == 'blog' && Yii::$app->controller->action->id == 'create'),
			'sortOrder' => 900,
		));

		$event->sender->addItem(array(
			'label' => Yii::t('BlogModule.base', 'Blog list'),
			'url' => Url::to(['/blog/blog/list']),
			'icon' => '<i class="fa fa-list"></i>',
			'isActive' => (Yii::$app->controller->module && Yii::$app->controller->module->id == 'blog' && Yii::$app->controller->action->id == 'list'),
			'sortOrder' => 1000,
		));

	}

}
