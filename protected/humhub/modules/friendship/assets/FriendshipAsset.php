<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2015 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\friendship\assets;

use yii\web\AssetBundle;

/**
 * Assets for like related resources.
 *
 * @since 1.2
 * @author buddha
 */
class FriendshipAsset extends AssetBundle
{

	/**
	 * @inheritdoc
	 */
	public $jsOptions = ['position' => \yii\web\View::POS_END];

	/**
	 * @inheritdoc
	 */
	public $sourcePath = '@friendship/resources';

	/**
	 * @inheritdoc
	 */
	public $js = [
		'js/humhub.friendship.js'
	];


}
