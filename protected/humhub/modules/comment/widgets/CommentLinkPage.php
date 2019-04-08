<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2017 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\comment\widgets;

use humhub\modules\user\models\User;
use Yii;

/**
 * This widget is used to show a comment link inside the wall entry controls.
 *
 * @since 0.5
 */
class CommentLinkPage extends \yii\base\Widget
{

	/**
	 * Content Object
	 */
	public $object;


	public $user;

	public $mode;

	public $options = [];

	/**
	 * Executes the widget.
	 */
	public function run()
	{

		if(!$this->user) {
			$this->user = User::findOne( $this->object->content->created_by );
		}
		return $this->render('linkPage', [
			'id' => $this->object->getUniqueId(),
			'object' => $this->object,
			'user' => $this->user,
			'url' => $this->options['commentPageUrl'],
			'mode' => $this->mode,
			'commentCount' => $this->getCommentsCount(),
		]);
	}

	/**
	 * Returns count of existing comments
	 *
	 * @return Int Comment Count
	 */
	public function getCommentsCount()
	{
		return \humhub\modules\comment\models\Comment::GetCommentCount(get_class($this->object), $this->object->getPrimaryKey());
	}

}