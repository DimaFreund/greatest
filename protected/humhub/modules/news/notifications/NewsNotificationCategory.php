<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2017 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\news\notifications;

use Yii;
use humhub\modules\notification\components\NotificationCategory;
use humhub\modules\notification\targets\BaseTarget;
use humhub\modules\notification\targets\MailTarget;

class NewsNotificationCategory extends NotificationCategory
{

	/**
	 * @inheritdoc
	 */
	public $id = 'news';

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
		return Yii::t('NewsModule.notifications_NewsNotificationCategory', 'Newss');
	}

	/**
	 * @inheritdoc
	 */
	public function getDescription()
	{
		return Yii::t('NewsModule.notifications_NewsNotificationCategory', 'Receive Notifications when someone created new news.');
	}

}
