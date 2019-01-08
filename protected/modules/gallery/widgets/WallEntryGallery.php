<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2015 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\gallery\widgets;

use humhub\modules\content\models\Category;
use humhub\modules\file\converter\PreviewImage;
use humhub\modules\gallery\models\Media;
use humhub\libs\MimeHelper;

/**
 * Widget that renders the Wallentry for a Media file.
 *
 * @package humhub.modules.gallery.widgets
 * @since 1.0
 * @author Sebastian Stumpf
 */
class WallEntryGallery extends \humhub\modules\content\widgets\WallEntry
{

	/**
	 * @inheritdoc
	 */
	public $editRoute = "/gallery/gallery/edit";

	/**
	 * @inheritdoc
	 */
	public $editMode = self::EDIT_MODE_MODAL;

	/**
	 * @inheritdoc
	 */
	public function run()
	{
		$gallery = $this->contentObject;

		$galleryUrl = '#';
		$galleryName = null;
		$category = new Category();
		$category = $category->getAllCurrentLanguage(\Yii::$app->language, 'gallery');
		$category = isset($category[$gallery->category])?$category[$gallery->category]:'';

		return $this->render('wallEntryGallery', [
			'gallery' => $gallery,
			'previewImage' => new PreviewImage(),
			'category' => $category,
		]);
	}

	/**
	 * Returns the edit url to edit the content (if supported)
	 *
	 * @return string url
	 */
	public function getEditUrl()
	{
		if (parent::getEditUrl() === "") {
			return "";
		}
		if ($this->contentObject instanceof Media) {
			return $this->contentObject->content->container->createUrl($this->editRoute, ['itemId' => $this->contentObject->getItemId(), 'fromWall' => true]);
		}
		return "";
	}

}
