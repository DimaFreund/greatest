<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2017 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\user\activities;

use Yii;
use humhub\modules\activity\components\BaseActivity;
use humhub\modules\activity\interfaces\ConfigurableActivityInterface;

/**
 * Description of MemberAdded
 *
 * @author luke
 */
class ChangeCity extends BaseActivity
{
	/**
	 * @inheritdoc
	 */
	public $viewName = "changeCity";

	/**
	 * @inheritdoc
	 */
	public $moduleId = "user";


	public $userAction = 'edited his profile info';
	/**
	 * @inheritdoc
	 */
	public function init()
	{
		$this->visibility = \humhub\modules\content\models\Content::VISIBILITY_PRIVATE;
		parent::init();
	}

//	public function getName()
//	{
//		return '';
//	}

	/**
	 * @inheritdoc
	 */


}
