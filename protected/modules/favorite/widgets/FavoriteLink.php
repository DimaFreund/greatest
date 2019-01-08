<?php

namespace humhub\modules\favorite\widgets;

use humhub\modules\favorite\models\Favorite;
use humhub\modules\user\models\User;
use Yii;
use humhub\modules\like\models\Like;
use yii\helpers\Url;
use yii\helpers\Html;

/**
 * This widget is used to show a favorite link inside the wall entry controls.
 *
 * @package humhub.modules_core.like
 * @since 0.5
 */
class FavoriteLink extends \yii\base\Widget
{

	/**
	 * The Object to be favorite
	 *
	 * @var type
	 */
	public $object;

	public $mode;

	/**
	 * Executes the widget.
	 */
	public function run()
	{
//		Yii::$app->assetManager->forceCopy = true;

		$currentUserFavorite = false;

		$model = Favorite::findOne(array('object_model' => $this->object->className(), 'object_id' => $this->object->id, 'created_by' => Yii::$app->user->id));

		$formatUser = false;
		if (isset($model) && !empty($model)) {
			$currentUserFavorite = true;
		}
		if($this->object instanceof User) {
			$formatUser = true;
		}
		return $this->render('favoriteLink', array(
			'object' => $this->object,
			'currentUserFavorited' => $currentUserFavorite,
			'formatUser' => $formatUser,
			'id' => $this->object->getUniqueId(),
			'favoriteUrl' => Url::to(['/favorite/favorite/favorite', 'contentModel' => $this->object->className(), 'contentId' => $this->object->id]),
			'unfavoriteUrl' => Url::to(['/favorite/favorite/unfavorite', 'contentModel' => $this->object->className(), 'contentId' => $this->object->id]),
			'mode' => $this->mode,
		));
	}



}

?>