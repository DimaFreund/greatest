<?php

namespace humhub\modules\polls\widgets;

use humhub\components\Widget;
use humhub\modules\content\models\Category;
use Yii;

/**
 * PollWallEntryWidget is used to display a poll inside the stream.
 *
 * This Widget will used by the Poll Model in Method getWallOut().
 *
 * @package humhub.modules.polls.widgets
 * @since 0.5
 * @author Luke
 */
class PollsItem extends Widget
{
	public $poll;

	public function run()
	{

		$category = new Category();
		$category = $category->getAllCurrentLanguage(Yii::$app->language, 'poll');

		return $this->render('polsItem', [
			'poll' => $this->poll,
			'contentContainer' => $this->poll->content->container,
			'category' => $category,
			]);
	}

}

?>