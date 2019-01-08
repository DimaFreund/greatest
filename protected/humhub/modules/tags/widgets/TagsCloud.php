<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2017 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\tags\widgets;

use humhub\modules\desire\models\forms\SearchForm;
use humhub\modules\tags\models\Tags;
use humhub\modules\tags\models\TagsRelationship;

/**
 * Displays the profile header of a user
 *
 * @since 0.5
 * @author Luke
 */
class TagsCloud extends \yii\base\Widget
{


	/**
	 * @inheritdoc
	 */
	public function run()
	{
		$tags = TagsRelationship::getPopularTags(31);
		$modelSearch = new SearchForm();

//		return $this->render('tagsCloud', array(
//			'tags' => $tags,
//			'model' => $modelSearch,
//		));
	}



}

?>
