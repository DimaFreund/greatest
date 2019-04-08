<?php

namespace humhub\components;


use humhub\modules\user\behaviors\ProfileController;
use Yii;
use yii\web\HttpException;

class GeneralController extends Controller {

	public $subLayout = "@humhub/views/layouts/_sublayout";

	public $contentContainer = null;

	public function init() {

		$this->contentContainer = YII::$app->user->getIdentity();
		if ( $this->contentContainer == null ) {
			throw new HttpException( 404, Yii::t( 'base', 'User not found!' ) );
		}

		$this->attachBehavior( 'ProfileControllerBehavior', [
			'class' => ProfileController::className(),
			'user'  => $this->contentContainer,
		] );


		parent::init();
	}

}
