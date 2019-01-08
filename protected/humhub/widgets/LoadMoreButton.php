<?php

namespace humhub\widgets;

class LoadMoreButton extends \yii\base\Widget
{

	public $count;

	public $object;

	public $user;

	public $ajaxUrl;


	public function run()
	{
		$userID = '';
		if(!empty($this->user)) {
			$userID = $this->user->id;
		}

		return $this->render('load-more-button', [
			'object' => $this->object,
			'count' => $this->count,
			'userID' => $userID,
			'ajaxUrl' => $this->ajaxUrl,
		]);
	}

}

?>