<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2015 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\news\permissions;

use Yii;
use humhub\modules\user\models\User;
use humhub\modules\space\models\Space;

/**
 * CreateNews Permission
 */
class CreateNews extends \humhub\libs\BasePermission
{

    /**
     * @inheritdoc
     */
    public $defaultAllowedGroups = [
        Space::USERGROUP_OWNER,
        Space::USERGROUP_ADMIN,
        Space::USERGROUP_MODERATOR,
        Space::USERGROUP_MEMBER,
        User::USERGROUP_SELF,
        User::USERGROUP_FRIEND
    ];

    /**
     * @inheritdoc
     */
    protected $fixedGroups = [
        Space::USERGROUP_USER,
        Space::USERGROUP_GUEST,
        User::USERGROUP_SELF
    ];

    /**
     * @inheritdoc
     */
    protected $moduleId = 'news';

    /**
     * @inheritdoc
     */
    public function getTitle()
    {
        return Yii::t('NewsModule.permissions', 'Create news');
    }

    /**
     * @inheritdoc
     */
    public function getDescription()
    {
        if ($this->contentContainer instanceof User) {
            return Yii::t('NewsModule.permissions', 'Allow others to create new newss on your profile page');
        }
        return Yii::t('NewsModule.permissions', 'Allows the user to create newss');
    }

}
