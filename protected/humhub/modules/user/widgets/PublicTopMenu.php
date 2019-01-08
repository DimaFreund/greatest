<?php
/**
 * Created by PhpStorm.
 * User: work
 * Date: 09.02.18
 * Time: 13:08
 */

namespace humhub\modules\user\widgets;



class PublicTopMenu extends \yii\base\Widget
{

	public $page;

	public function run()
	{
		return $this->render('publicTopMenu');
	}
}