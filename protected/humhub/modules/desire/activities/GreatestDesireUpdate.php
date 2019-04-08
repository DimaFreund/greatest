<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2017 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\desire\activities;

use Yii;
use humhub\modules\activity\components\BaseActivity;
use humhub\modules\activity\interfaces\ConfigurableActivityInterface;

/**
 * Description of MemberAdded
 *
 * @author luke
 */
class GreatestDesireUpdate extends BaseActivity
{
	/**
	 * @inheritdoc
	 */
	public $viewName = "greatestDesireUpdate";

	/**
	 * @inheritdoc
	 */
	public $moduleId = "desire";


	public $userAction = 'update his';
	/**
	 * @inheritdoc
	 */
	public function init()
	{
		$this->visibility = \humhub\modules\content\models\Content::VISIBILITY_PRIVATE;
		parent::init();
	}

	public function getName()
	{
		return 'Greatest Desire';
	}

	/**
	 * @inheritdoc
	 */


}
