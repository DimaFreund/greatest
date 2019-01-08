<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2016 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\content\widgets;
use Codeception\Util\Debug;
use humhub\modules\comment\widgets\CommentLink;
use humhub\modules\comment\widgets\CommentLinkPage;
use humhub\modules\desire\models\Desire;
use humhub\modules\favorite\widgets\FavoriteLink;
use humhub\modules\like\widgets\LikeLink;
use humhub\modules\rating\widgets\RatingLink;
use humhub\modules\sharebetween\widgets\ShareLink;

/**
 * Delete Link for Wall Entries
 *
 * This widget will attached to the WallEntryControlsWidget and displays
 * the "Delete" Link to the Content Objects.
 *
 * @package humhub.modules_core.wall.widgets
 * @since 0.5
 */
class BottomPanelContent extends \yii\base\Widget
{

	/**
	 * @var \humhub\modules\content\components\ContentActiveRecord
	 */
	public $object = null;

	const FULL_MODE = 0;
	const SMALL_MODE = 1;

	public $mode = self::FULL_MODE;

	public $components = ['CommentLink' => 1, 'CommentLinkPage' => 0, 'LikeLink' => 1, 'RatingLink' => 0, 'ShareLink' => 1, 'FavoriteLink' => 1];

	public $commentLinkPage = false;

	public $ratingLink = false;

	public $options = [];

	/**
	 * Executes the widget.
	 */
	public function run()
	{
		if ($this->object instanceof Desire) {
			$this->ratingLink = true;
		}

		if ($this->commentLinkPage) {
			$this->components['CommentLinkPage'] = 1;
			$this->components['CommentLink'] = 0;
		}
		if ($this->ratingLink) {
			$this->components['RatingLink'] = 1;
			$this->components['LikeLink'] = 0;
		}


		foreach ($this->components as $component => $status) {
			if($status) {
				switch ($component) {
					case 'CommentLink':
						echo CommentLink::widget(['object' => $this->object, 'mode' => $this->mode]);
						break;
					case 'CommentLinkPage':
						echo CommentLinkPage::widget(['object' => $this->object, 'mode' => $this->mode, 'options' => $this->options]);
						break;
					case 'LikeLink':
						echo LikeLink::widget(['object' => $this->object, 'mode' => $this->mode]);
						break;
					case 'RatingLink':
						echo RatingLink::widget(['object' => $this->object, 'mode' => $this->mode]);
						break;
					case 'ShareLink':
						echo ShareLink::widget(['object' => $this->object, 'mode' => $this->mode]);
						break;
					case 'FavoriteLink':
						echo FavoriteLink::widget(['object' => $this->object, 'mode' => $this->mode]);
						break;
				}
			}
		}
	}
}

?>