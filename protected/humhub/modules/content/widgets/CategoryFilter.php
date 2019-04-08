<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2015 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\content\widgets;

use humhub\libs\BasePermission;
use humhub\modules\content\models\Category;
use Yii;

/**
 * Edit Link for Wall Entries
 *
 * This widget will attached to the WallEntryControlsWidget and displays
 * the "Edit" Link to the Content Objects.
 *
 * @package humhub.modules_core.wall.widgets
 * @since 0.10
 */
class CategoryFilter extends \yii\base\Widget
{

	/**
	 * @var \humhub\modules\content\components\ContentActiveRecord
	 */
	public $model = null;


	/**
	 * Executes the widget.
	 */
	public function run()
	{

		$model = new Category();
		$category = $model->getAllCurrentLanguage(Yii::$app->language, $this->model);

		$model->load(Yii::$app->request->get());

		return $this->render('categoryFilter', [
			'model' => $model,
			'category' => $category,
		]);
	}

}

?>