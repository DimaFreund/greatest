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
class PagesMenu extends \humhub\widgets\BaseMenu
{

	/**
	 * @inheritdoc
	 */
	public $template = "@humhub/widgets/views/tabMenu";

	public function init()
	{
		$canEditSettings = Yii::$app->user->can(new \humhub\modules\admin\permissions\ManageSettings());



		$this->addItem([
			'label' => Yii::t('AdminModule.widgets_AdminMenuWidget', 'Start Page'),
			'url' => Url::toRoute('/admin/pages/welcome'),
			'sortOrder' => 1100,
			'isActive' => (Yii::$app->controller->module && Yii::$app->controller->module->id == 'admin' && Yii::$app->controller->id == 'pages' && Yii::$app->controller->action->id == 'welcome'),
			'isVisible' => $canEditSettings
		]);

		$this->addItem([
			'label' => Yii::t('AdminModule.widgets_AdminMenuWidget', 'About network'),
			'url' => Url::toRoute('/admin/pages/anetwork'),
			'sortOrder' => 1100,
			'isActive' => (Yii::$app->controller->module && Yii::$app->controller->module->id == 'admin' && Yii::$app->controller->id == 'pages' && Yii::$app->controller->action->id == 'anetwork'),
			'isVisible' => $canEditSettings
		]);
		$this->addItem([
			'label' => Yii::t('AdminModule.widgets_AdminMenuWidget', 'Privacy policy'),
			'url' => Url::toRoute('/admin/pages/policy'),
			'sortOrder' => 1100,
			'isActive' => (Yii::$app->controller->module && Yii::$app->controller->module->id == 'admin' && Yii::$app->controller->id == 'pages' && Yii::$app->controller->action->id == 'policy'),
			'isVisible' => $canEditSettings
		]);
		$this->addItem([
			'label' => Yii::t('AdminModule.widgets_AdminMenuWidget', 'Terms and Conditions'),
			'url' => Url::toRoute('/admin/pages/conditions'),
			'sortOrder' => 1100,
			'isActive' => (Yii::$app->controller->module && Yii::$app->controller->module->id == 'admin' && Yii::$app->controller->id == 'pages' && Yii::$app->controller->action->id == 'conditions'),
			'isVisible' => $canEditSettings
		]);
		$this->addItem([
			'label' => Yii::t('AdminModule.widgets_AdminMenuWidget', 'FAQ'),
			'url' => Url::toRoute('/admin/pages/faq'),
			'sortOrder' => 1100,
			'isActive' => (Yii::$app->controller->module && Yii::$app->controller->module->id == 'admin' && Yii::$app->controller->id == 'pages' && Yii::$app->controller->action->id == 'faq'),
			'isVisible' => $canEditSettings
		]);


		parent::init();
	}

}
