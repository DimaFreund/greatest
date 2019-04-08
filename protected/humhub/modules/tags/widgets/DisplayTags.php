<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2017 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\tags\widgets;

/**
 * Displays the profile header of a user
 *
 * @since 0.5
 * @author Luke
 */
class DisplayTags extends \yii\base\Widget
{

	/**
	 * @var User
	 */
	public $user;


	/**
	 * @inheritdoc
	 */
	public function run()
	{


		return $this->render('displayTags', array(
			'tags' => $this->user->tags,
		));
	}



}

?>
