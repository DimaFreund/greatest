<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2017 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\admin\widgets;

use humhub\components\i18n\I18N;
use Yii;
use yii\helpers\Url;

/**
 * Group Administration Menu
 */
class LanguageCategoryMenu extends \humhub\widgets\BaseMenu
{

	/**
	 * @inheritdoc
	 */
	public $template = "@humhub/widgets/views/tabMenu";

	public function init()
	{
		$canEditSettings = Yii::$app->user->can(new \humhub\modules\admin\permissions\ManageSettings());


		$language = new I18N();
		$languagelist = $language->getAllowedLanguages();
		$increment = 0;
		foreach($languagelist as $key=>$name){
			$increment += 100;
			$this->addItem([
				'label' => Yii::t('AdminModule.widgets_AdminMenuWidget', $name),
				'url' => Url::current(['lan'=> $key], TRUE),
				'sortOrder' => $increment,
				'isActive' => (Yii::$app->controller->module && Yii::$app->controller->module->id == 'admin' && Yii::$app->controller->id == 'category' && Yii::$app->request->get('lan') == $key),
				'isVisible' => $canEditSettings
			]);

		}




		parent::init();
	}

}
