<?php
/**
 * Created by PhpStorm.
 * User: work
 * Date: 09.02.18
 * Time: 13:08
 */

namespace humhub\modules\user\widgets;

class AuthMenuTop extends \yii\base\Widget
{
	public function run()
	{
		return $this->render('authMenuTop');
	}
}