<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2015 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\favorite;

use humhub\modules\favorite\models\Favorite;

/**
 * Events provides callbacks to handle events.
 *
 * @author luke
 */
class Events extends \yii\base\Object
{

	/**
	 * On User delete, also delete all comments
	 *
	 * @param type $event
	 */
	public static function onUserDelete($event)
	{
		foreach (Favorite::findAll(array('created_by' => $event->sender->id)) as $favorite) {
			$favorite->delete();
		}

		return true;
	}

	public static function onActiveRecordDelete($event)
	{
		$record = $event->sender;
		if ($record->hasAttribute('id')) {
			foreach (Favorite::findAll(array('object_id' => $record->id, 'object_model' => $record->className())) as $favorite) {
				$favorite->delete();
			}
		}
	}

	/**
	 * Callback to validate module database records.
	 *
	 * @param Event $event
	 */
	public static function onIntegrityCheck($event)
	{
		$integrityController = $event->sender;
		$integrityController->showTestHeadline("Favorite (" . Favorite::find()->count() . " entries)");

		foreach (Favorite::find()->all() as $favorite) {
			if ($favorite->source === null) {
				if ($integrityController->showFix("Deleting favorite id " . $favorite->id . " without existing target!")) {
					$favorite->delete();
				}
			}
			// User exists
			if ($favorite->user === null) {
				if ($integrityController->showFix("Deleting favorite id " . $favorite->id . " without existing user!")) {
					$favorite->delete();
				}
			}
		}
	}

	/**
	 * On initalizing the wall entry controls also add the favorite link widget
	 *
	 * @param type $event
	 */
	public static function onWallEntryLinksInit($event)
	{
		$event->sender->addWidget(widgets\FavoriteLink::className(), array('object' => $event->sender->object), array('sortOrder' => 10));
	}

}
