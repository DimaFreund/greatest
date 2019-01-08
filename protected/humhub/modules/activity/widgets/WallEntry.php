<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2015 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\activity\widgets;

/**
 * @inheritdoc
 */
class WallEntry extends \humhub\modules\content\widgets\WallEntry
{

	/**
	 * @inheritdoc
	 */
//	public $editRoute = "/desire/desire/edit";
	public $contentInner = '';
	public $userAction = '';
	public $objectName = '';

	/**
	 * @inheritdoc
	 */
	public function run()
	{
		return $this->contentInner;
	}

}
