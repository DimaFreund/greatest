<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2017 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\content\widgets;

use Yii;
use humhub\components\Widget;
use humhub\modules\space\models\Space;
use humhub\modules\user\models\User;
use humhub\modules\content\components\ContentContainerController;

/**
 * WallEntry is responsible to show a content inside a stream/wall.
 *
 * @see \humhub\modules\content\components\ContentActiveRecord
 * @since 0.20
 * @author luke
 */
class ContentControlLinks extends Widget
{


	public $contentObject;

	public $editRoute = "";

	public $controlsOptions = [];

	public function run() {


		return $this->render('contentControlLinks', [
			'contentObject' => $this->contentObject,
			'wallEntryWidget' => $this,
		]);
	}

	/**
	 * Returns the edit url to edit the content (if supported)
	 *
	 * @return string url
	 */
	public function getEditUrl()
	{
		if (empty($this->editRoute) || !$this->contentObject->content || !$this->contentObject->content->container) {
			return;
		}

		// Don't show edit link, when content container is space and archived
		if ($this->contentObject->content->container instanceof Space && $this->contentObject->content->container->status == Space::STATUS_ARCHIVED) {
			return "";
		}

		return $this->contentObject->content->container->createUrl($this->editRoute, ['id' => $this->contentObject->id]);
	}

	/**
	 * Returns an array of contextmenu items either in form of a single array:
	 *
	 * ['label' => 'mylabel', 'icon' => 'fa-myicon', 'data-action-click' => 'myaction', ...]
	 *
	 * or as widget type definition:
	 *
	 * [MyWidget::class, [...], [...]]
	 *
	 * If an $editRoute is set this function will include an edit button.
	 * The edit logic can be changed by changing the $editMode.
	 *
	 * @return array
	 * @since 1.2
	 */
	public function getContextMenu()
	{
		$result = [];
		if (!empty($this->getEditUrl())) {
			$this->addControl($result, [EditLink::class, ['model' => $this->contentObject, 'mode' => $this->editMode, 'url' => $this->getEditUrl()], ['sortOrder' => 200]]);
		}

		$this->addControl($result, [DeleteLink::class, ['content' => $this->contentObject], ['sortOrder' => 100]]);
		$this->addControl($result, [VisibilityLink::class, ['contentRecord' => $this->contentObject], ['sortOrder' => 250]]);
		$this->addControl($result, [NotificationSwitchLink::class, ['content' => $this->contentObject], ['sortOrder' => 300]]);
		$this->addControl($result, [PermaLink::class, ['content' => $this->contentObject], ['sortOrder' => 400]]);
		$this->addControl($result, [PinLink::class, ['content' => $this->contentObject], ['sortOrder' => 500]]);
		$this->addControl($result, [ArchiveLink::class, ['content' => $this->contentObject], ['sortOrder' => 600]]);

		if(isset($this->controlsOptions['add'])) {
			foreach ($this->controlsOptions['add'] as $linkOptions) {
				$this->addControl($result, $linkOptions);
			}
		}

		return $result;
	}

	protected function addControl(&$result, $options) {
		if(isset($this->controlsOptions['prevent']) && isset($options[0]) && in_array($options[0], $this->controlsOptions['prevent'])) {
			return;
		}

		$result[] = $options;
	}



}
