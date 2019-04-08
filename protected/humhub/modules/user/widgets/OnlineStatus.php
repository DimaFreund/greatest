<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2017 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\user\widgets;

use humhub\modules\desire\models\Desire;
use humhub\modules\user\components\Session;
use Yii;
use humhub\modules\space\models\Space;
use humhub\modules\user\models\User;
use humhub\modules\space\models\Membership;
use humhub\modules\friendship\models\Friendship;
use humhub\modules\user\controllers\ImageController;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/**
 * Displays the profile header of a user
 *
 * @since 0.5
 * @author Luke
 */
class OnlineStatus extends \yii\base\Widget
{

	/**
	 * @var User
	 */
	public $user;

	/**
	 * @var boolean is owner of the current profile
	 */
	protected $isProfileOwner = false;

	private $arrayStatusOnline = [
		'0' => 'Online',
		'1' => 'Offline',
		'2' => 'Away',
		'3' => 'Busy',
	];
	/**
	 * @inheritdoc
	 */
	public function init()
	{
		/**
		 * Try to autodetect current user by controller
		 */
		if ($this->user === null) {
			$this->user = $this->getController()->getUser();
		}

		if (!Yii::$app->user->isGuest && Yii::$app->user->id == $this->user->id) {
			$this->isProfileOwner = true;
		}

		parent::init();
	}

	/**
	 * @inheritdoc
	 */
	public function run()
	{

		$arrayStatusOnlineClass = ArrayHelper::getColumn($this->arrayStatusOnline, function($element) {
			return ['class' => strtolower($element)];
		});

		if(!$this->user->status_online) {
		$online_user = Session::getOnlineUsers();
			if ( empty( $online_user->andWhere( [ 'user.id' => $this->user->id ] )->all() ) ){
				$this->user->status_online = 1;
			}
		}

		$actionUrl = Url::to(['/user/account/change-status-online']);

		return $this->render('onlineStatus', array(
			'user' => $this->user,
			'isProfileOwner' => $this->isProfileOwner,
			'arrayStatusOnline' => $this->arrayStatusOnline,
			'arrayStatusOnlineClass' => $arrayStatusOnlineClass,
			'actionUrl' => $actionUrl,
		));
	}

}

?>
