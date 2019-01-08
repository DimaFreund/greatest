<?php

namespace humhub\modules\rating\widgets;

use humhub\modules\rating\models\Rating;
use Yii;

class RatingDisplay extends \yii\base\Widget
{

	public $object;

	public function run()
	{

		$data = Rating::getRatingDesire($this->object->id);

		$count = $data['count'];

		$rating = $data['rating'];

		return $this->render('rating-display', [
			'rating' => $rating,
			'count'  => $count,
		]);
	}

}