<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2017 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\friendship\activities;

use Yii;
use humhub\modules\activity\components\BaseActivity;
use humhub\modules\activity\interfaces\ConfigurableActivityInterface;

/**
 * Description of MemberAdded
 *
 * @author luke
 */
class FriendAdded extends BaseActivity
{
	/**
	 * @inheritdoc
	 */
	public $viewName = "friendAdded";

	/**
	 * @inheritdoc
	 */
	public $moduleId = "friendship";


	public $userAction = 'is now friends with';
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
		return $this->source->displayName;
	}


}
