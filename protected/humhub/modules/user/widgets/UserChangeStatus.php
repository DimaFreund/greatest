<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2016 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\user\widgets;

use Yii;
use yii\bootstrap\Html;
use humhub\modules\friendship\models\Friendship;

/**
 * UserFollowButton
 *
 * @author luke
 * @since 0.11
 */
class UserChangeStatus extends \yii\base\Widget
{

	/**
	 * @var \humhub\modules\user\models\User
	 */
	public $user;

	public function init()
	{
		$this->user =  Yii::$app->user->getIdentity();
	}

	/**
	 * @inheritdoc
	 */
	public function run()
	{
		return $this->render('userChangeStatus', ['model' => $this->user]);

	}

}
