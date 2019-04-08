<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2015 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\blog\widgets;
use humhub\modules\content\models\Category;

/**
 * @inheritdoc
 */
class WallEntry extends \humhub\modules\content\widgets\WallEntry
{

    /**
     * @inheritdoc
     */
    public $editRoute = "/blog/blog/edit";

    /**
     * @inheritdoc
     */
    public function run()
    {

    	$category = new Category();
    	$category = $category->getAllCurrentLanguage(\Yii::$app->language, 'blog');

        return $this->render('wallEntry', array(
        	'blog' => $this->contentObject,
	        'justEdited' => $this->justEdited,
	        'category' => $category,
        ));
    }

}
