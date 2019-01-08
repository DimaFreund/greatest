<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2016 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\file\widgets;

use humhub\components\ActiveRecord;
use humhub\modules\file\converter\PreviewImage;
use humhub\modules\gallery\models\Media;
use Yii;
use humhub\modules\content\components\ContentActiveRecord;

/**
 * This widget is used include the files functionality to a wall entry.
 *
 * @since 0.5
 */
class ShowPhotoPreview extends \yii\base\Widget
{

	/**
	 * @var ActiveRecord Object to show files from
	 */
	public $object = null;

	/**
	 * @var bool if set to false this widget won't be rendered
	 */
	public $active = true;

	/**
	 * @var bool if set to false this widget won't render file previews as images/videos/audio
	 */
	public $preview = true;

	/**
	 * Executes the widget.
	 */
	public $options = [];


	public function run()
	{
		if(!$this->active) {
			return;
		}

		if ($this->object instanceof ContentActiveRecord) {
			$widget = $this->object->getWallEntryWidget();

			// File widget disabled in this wall entry
			if ($widget->showFiles === false) {
				return;
			}
		}


		if($this->object instanceof Media) {
			$files = [$this->object->baseFile];
		} else {
			$files = $this->object->fileManager->findStreamFiles();
		}


		$hidePreviewFileInfo = ($this->preview) ? Yii::$app->getModule('file')->settings->get('hideImageFileInfo') : false;

		return $this->render('showPhotoPreview', [
			'files' => $files,
			'object' => $this->object,
			'previewImage' => new PreviewImage(),
			'showPreview' => $this->preview,
			'hideImageFileInfo' => $hidePreviewFileInfo,
			'options' => $this->options,
		]);
	}

}

?>