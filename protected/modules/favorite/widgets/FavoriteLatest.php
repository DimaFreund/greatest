<?php

namespace humhub\modules\favorite\widgets;

use humhub\modules\blog\models\Blog;
use humhub\modules\desire\models\Desire;
use humhub\modules\favorite\models\Favorite;
use humhub\modules\gallery\models\CustomGallery;
use humhub\modules\gallery\models\Media;
use humhub\modules\polls\models\Poll;
use humhub\modules\space\models\Space;
use humhub\modules\user\models\User;
use Yii;


/**
 * This widget is used to show a favorite link inside the wall entry controls.
 *
 * @package humhub.modules_core.like
 * @since 0.5
 */
class FavoriteLatest extends \yii\base\Widget
{

	public $latest;

	public function run()
	{

		$latest = $this->latest;

		$object = $latest->object_model::findOne(['id' => $latest->object_id]);

		if($object instanceof User || $object instanceof Space) {
			$user = $object;
		} else {
			$user = $object->content->user;
		}

//		$ownerContent = User::findOne(['id' => $object->content->created_by]);

		return $this->render('latest', array(
			'latest' => $latest,
			'object' => $object,
			'user' => $user,
		));
	}



}

?>