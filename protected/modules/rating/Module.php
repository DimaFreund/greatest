<?php

namespace humhub\modules\rating;

use modules\rating\models\Rating;

class Module extends \humhub\components\Module
{

	/**
	 * @inheritdoc
	 */
	public function disable()
	{
		foreach (Rating::find()->all() as $share) {
			$share->delete();
		}

		parent::disable();
	}

}
