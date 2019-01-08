<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2016 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\friendship\controllers;


use humhub\modules\desire\models\Desire;
use humhub\modules\user\components\Session;
use humhub\modules\user\models\User;
use Yii;
use yii\data\ActiveDataProvider;

use humhub\modules\user\components\BaseAccountController;
use humhub\modules\friendship\models\Friendship;
use humhub\modules\friendship\models\SettingsForm;
use yii\helpers\ArrayHelper;


/**
 * Membership Manage Controller
 *
 * @author luke
 */
class ManageController extends BaseAccountController
{

	public function actionIndex()
	{
		return $this->redirect(['list']);
	}

	public function actionList($id)
	{
		$this->user = User::findOne($id);
		$data = Friendship::getAllFriends($this->user, 10);
		$ajaxUrl = '/friendship/manage/friend-list-ajax';

		$this->subLayout = $this->subLayout = "@humhub/modules/user/views/profile/_layout";

		$online_freinds = Friendship::getOnlineFriends($this->user)->all();

		$friends = $data['friends'];
		$count = $data['count'];

		foreach($friends as $friend) {
			if(!$friend->status_online) {
				foreach ( $online_freinds as $online_freind ) {
					if ( $friend->id === $online_freind->id ) {
						$friend->status_online = 1;
						break;
					}
				}
			}
		};
		if(!$this->user->status_online) {
			$this->user->status_online = 1;
		}

		return $this->render('list', [
			'user' => $this->user,
			'friends' => $friends,
			'count' => $count,
			'ajaxUrl' => $ajaxUrl,
		]);
	}

	public function actionFriendListAjax($id, $offset)
	{
		$this->user = User::findOne($id);
		$friends = Friendship::getPartFriends($this->user, $offset);

		$online_freinds = Friendship::getOnlineFriends($this->user)->all();

		foreach($friends as $friend) {
			if(!$friend->status_online) {
				foreach ( $online_freinds as $online_freind ) {
					if ( $friend->id === $online_freind->id ) {
						$friend->status_online = 1;
						break;
					}
				}
			}
		};
		Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		$result['html'] = $this->renderAjax('list-ajax', [
			'friends' => $friends,
			]);
		$result['count'] = count($friends);
		return $result;
	}

	public function actionRequests()
	{
		$dataProvider = new ActiveDataProvider([
			'query' => Friendship::getReceivedRequestsQuery($this->getUser()),
			'pagination' => [
				'pageSize' => 20,
			],
		]);

		return $this->render('requests', [
			'user' => $this->getUser(),
			'dataProvider' => $dataProvider
		]);
	}

	public function actionSentRequests()
	{
		$dataProvider = new ActiveDataProvider([
			'query' => Friendship::getSentRequestsQuery($this->getUser()),
			'pagination' => [
				'pageSize' => 20,
			],
		]);

		return $this->render('sent-requests', [
			'user' => $this->getUser(),
			'dataProvider' => $dataProvider
		]);
	}

	public function actionGetNewRequestsCountJson()
	{
		Yii::$app->response->format = 'json';

		$json = array();
		$json['newRequests'] = Friendship::getReceivedRequestsQuery(Yii::$app->user->getIdentity())->count();

		return $json;
	}

	public function actionRequestsList()
	{
		$dataProvider = new ActiveDataProvider([
			'query' => Friendship::getReceivedRequestsQuery($this->getUser()),
			'pagination' => [
				'pageSize' => 5,
			],
		]);

		$requests = $dataProvider->getModels();
		$users = $this->loadDesire($requests);
		return $this->renderAjax('requests-list', ['users' => $users]);
	}

	public function actionOnlineList()
	{

		$online_freinds = Friendship::getOnlineFriends($this->getUser())->all();

		$online_freinds = $this->loadDesire($online_freinds);

		return $this->renderAjax('online-list', ['online' => $online_freinds]);
	}

	public function loadDesire($users) {
		$result = ArrayHelper::getColumn($users, function($element) {

			$element->greatest_desire = Desire::getGreatestDesire($element);

			return $element;
		});

		return $result;
	}

}
