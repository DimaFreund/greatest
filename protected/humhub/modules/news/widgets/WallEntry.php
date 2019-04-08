<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2015 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\news\widgets;
use humhub\modules\content\models\Category;
use Yii;
use yii\helpers\Url;

/**
 * @inheritdoc
 */
class WallEntry extends \humhub\modules\content\widgets\WallEntry
{

    /**
     * @inheritdoc
     */
    public $editRoute = "/news/news/update";

    public $editMode = self::EDIT_MODE_NEW_WINDOW;

    public $showHeader = false;

    /**
     * @inheritdoc
     */
    public function run()
    {

	    $category = new Category();
	    $category = $category->getAllCurrentLanguage(Yii::$app->language, 'news');

        return $this->render('wallEntry',
	        array(
	        	'news' => $this->contentObject,
		        'justEdited' => $this->justEdited,
		        'category' => $category,
	        ));
    }

    public function getEditUrl() {
	    return Url::toRoute(['/admin/news/update', 'id' => $this->contentObject->id]);
    }

}
