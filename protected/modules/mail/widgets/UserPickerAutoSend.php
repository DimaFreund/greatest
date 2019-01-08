<?php

namespace humhub\modules\mail\widgets;

use humhub\components\Widget;
use humhub\modules\mail\models\UserMessage;
use humhub\modules\user\widgets\UserPicker;

/**
 * @package humhub.modules.mail
 * @since 0.5
 */
class UserPickerAutoSend extends UserPicker
{

	/**
	 * Creates the Wall Widget
	 */
	protected static function createJSONUserInfo($user, $permission = null, $priority = null)
	{
		$result = parent::createJSONUserInfo($user, $permission = null, $priority = null);
		$result['autoSend'] = 1;
		return $result;
	}

}

?>