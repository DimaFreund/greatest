<?php

namespace humhub\modules\rating\widgets;

use humhub\modules\rating\models\Rating;
use Yii;

class RatingLink extends \yii\base\Widget
{

	public $object;

	public $mode;

	public function run()
	{
		$currentUserVoice = false;

		$model = Rating::getCurrentUserVoice($this->object->id);

		if($model) {
			$currentUserVoice = $model->rating;
		} else {
			$currentUserVoice = 0;
		}

		return $this->render('rating-link', [
			'currentUserVoice' => $currentUserVoice,
			'object' => $this->object,
			'mode' => $this->mode,
		]);
	}

}