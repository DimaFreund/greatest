<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2017 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\desire\notifications;

use Yii;
use humhub\modules\notification\components\NotificationCategory;
use humhub\modules\notification\targets\BaseTarget;
use humhub\modules\notification\targets\MailTarget;

/**
 * LikeNotificationCategory
 *
 * @author buddha
 */
class DesireNotificationCategory extends NotificationCategory
{

	/**
	 * @inheritdoc
	 */
	public $id = 'desire';

	/**
	 * @inheritdoc
	 */
	public function getDefaultSetting(BaseTarget $target)
	{
		if ($target instanceof MailTarget) {
			return false;
		}

		return parent::getDefaultSetting($target);
	}

	/**
	 * @inheritdoc
	 */
	public function getTitle()
	{
		return Yii::t('DesireModule.notifications_DesireNotificationCategory', 'Desires');
	}

	/**
	 * @inheritdoc
	 */
	public function getDescription()
	{
		return Yii::t('DesireModule.notifications_DesireNotificationCategory', 'Receive Notifications when someone created new desire.');
	}

}
