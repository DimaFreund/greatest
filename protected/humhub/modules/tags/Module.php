<?php

namespace humhub\modules\tags;

use Yii;

/**
 * This module provides like support for Content and Content Addons
 * Each wall entry will get a Like Button and a overview of likes.
 *
 * @since 0.5
 */
class Module extends \humhub\components\Module
{

	public $isCoreModule = true;

	public function getName()
	{
		return Yii::t('TagsModule.base', 'Tags');
	}

	/**
	 * @inheritdoc
	 */
	public function getNotifications()
	{
		return [
			'humhub\modules\tags\notifications\NewTags'
		];
	}

}
