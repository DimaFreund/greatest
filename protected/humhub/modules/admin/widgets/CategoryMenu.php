<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2017 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\admin\widgets;

use Yii;
use yii\helpers\Url;

/**
 * Group Administration Menu
 */
class CategoryMenu extends \humhub\widgets\BaseMenu
{

	/**
	 * @inheritdoc
	 */
	public $template = "@humhub/widgets/views/tabMenu";

	public function init()
	{
		$canEditSettings = Yii::$app->user->can(new \humhub\modules\admin\permissions\ManageSettings());



		$this->addItem([
			'label' => Yii::t('AdminModule.widgets_AdminMenuWidget', 'Blog'),
			'url' => Url::toRoute('/admin/category/blog?lan=en'),
			'sortOrder' => 100,
			'isActive' => (Yii::$app->controller->module && Yii::$app->controller->module->id == 'admin' && Yii::$app->controller->id == 'category' && Yii::$app->controller->action->id == 'blog'),
			'isVisible' => $canEditSettings
		]);

		$this->addItem([
			'label' => Yii::t('AdminModule.widgets_AdminMenuWidget', 'Space'),
			'url' => Url::toRoute('/admin/category/space?lan=en'),
			'sortOrder' => 200,
			'isActive' => (Yii::$app->controller->module && Yii::$app->controller->module->id == 'admin' && Yii::$app->controller->id == 'category' && Yii::$app->controller->action->id == 'space'),
			'isVisible' => $canEditSettings
		]);
		$this->addItem([
			'label' => Yii::t('AdminModule.widgets_AdminMenuWidget', 'Gallery'),
			'url' => Url::toRoute('/admin/category/gallery?lan=en'),
			'sortOrder' => 300,
			'isActive' => (Yii::$app->controller->module && Yii::$app->controller->module->id == 'admin' && Yii::$app->controller->id == 'category' && Yii::$app->controller->action->id == 'gallery'),
			'isVisible' => $canEditSettings
		]);
		$this->addItem([
			'label' => Yii::t('AdminModule.widgets_AdminMenuWidget', 'Poll'),
			'url' => Url::toRoute('/admin/category/poll?lan=en'),
			'sortOrder' => 300,
			'isActive' => (Yii::$app->controller->module && Yii::$app->controller->module->id == 'admin' && Yii::$app->controller->id == 'category' && Yii::$app->controller->action->id == 'poll'),
			'isVisible' => $canEditSettings
		]);
		$this->addItem([
			'label' => Yii::t('AdminModule.widgets_AdminMenuWidget', 'News'),
			'url' => Url::toRoute('/admin/category/news?lan=en'),
			'sortOrder' => 300,
			'isActive' => (Yii::$app->controller->module && Yii::$app->controller->module->id == 'admin' && Yii::$app->controller->id == 'category' && Yii::$app->controller->action->id == 'news'),
			'isVisible' => $canEditSettings
		]);


		parent::init();
	}

}
