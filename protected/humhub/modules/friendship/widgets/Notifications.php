<?php

namespace humhub\modules\friendship\widgets;

use humhub\components\Widget;
use humhub\modules\friendship\models\Friendship;
use humhub\modules\user\components\Session;
use Yii;

/**
 * @package humhub.modules.mail
 * @since 0.5
 */
class Notifications extends Widget
{

	/**
	 * Creates the Wall Widget
	 */
	public function run()
	{

		$receivedRequestsCount = Friendship::getReceivedRequestsQuery(Yii::$app->user->getIdentity())->count();

		$online_user = Friendship::getOnlineFriends(Yii::$app->user->getIdentity())->count();
		return $this->render('notifications', array(
			'receivedRequestsCount' => $receivedRequestsCount,
			'count_online_user'     => $online_user,
		));
	}

}

?>