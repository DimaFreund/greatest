<?php

namespace humhub\modules\mail\models;

use Yii;
use yii\base\Model;
use yii\httpclient\Client;

class Chat extends Model
{
	public $user;

	public $client;

	public function init(){

		$this->client = new Client();

		parent::init();
	}

	public function loginUser()
	{

		$response = $this->client->createRequest()
		                   ->setMethod('post')
		                   ->setUrl('https://gd-chat.page.ua/api/login')
		                   ->setData(['user' => str_replace(' ', '_', $this->user->username), 'password' => $this->user->guid])
		                   ->send();


		$dataResponse = json_decode($response->content);

		if($dataResponse->status === 'error') {
			return false;
		} else {
			return $dataResponse->data->authToken;
		}



	}

	public function registerUser()
	{
		$dataResponse = $this->client->createRequest()
		                       ->setMethod('post')
		                       ->setUrl('https://gd-chat.page.ua/api/v1/users.register')
		                       ->setData(['username' => str_replace(' ', '_', $this->user->username),
		                                  'email' => $this->user->email,
		                                  'pass' => $this->user->guid,
		                                  'name' => $this->user->profile->firstname?$this->user->profile->firstname:$this->user->username,
		                       ])
		                       ->send();

	}

	public function authentication($user = null)
	{
		if(!$user){
			$user = Yii::$app->user->getIdentity();
		}
		$this->user = $user;


		$login = self::loginUser();
		
		if($login) {
			return $login;
		} else {
			$this->registerUser();
			return self::loginUser();
		}

	}

}
