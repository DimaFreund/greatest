<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2016 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\friendship\widgets;

use Yii;
use humhub\modules\friendship\models\Friendship;

/**
 * Displays a membership button between the current and given user.
 *
 * @author luke
 */
class FriendshipButton extends \yii\base\Widget
{

    /**
     * @var User the target user 
     */
    public $object;

    /**
     * @inheritdoc
     */
    public function run()
    {

	    Yii::$app->assetManager->forceCopy = true;

        if (!Yii::$app->getModule('friendship')->getIsEnabled()) {
            return;
        }
        
        // Do not display a buttton if user is it self or guest
        if ($this->object->isCurrentUser() || \Yii::$app->user->isGuest) {
            return;
        }

        return $this->render('friendshipButton', array(
                    'user' => $this->object,
                    'friendshipState' => Friendship::getStateForUser(Yii::$app->user->getIdentity(), $this->object)
        ));
    }

}
