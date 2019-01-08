<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2015 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\desire\permissions;

use Yii;
use humhub\modules\user\models\User;
use humhub\modules\space\models\Space;

/**
 * CreateDesire Permission
 */
class CreateDesire extends \humhub\libs\BasePermission
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
    protected $moduleId = 'desire';

    /**
     * @inheritdoc
     */
    public function getTitle()
    {
        return Yii::t('DesireModule.permissions', 'Create desire');
    }

    /**
     * @inheritdoc
     */
    public function getDescription()
    {
        if ($this->contentContainer instanceof User) {
            return Yii::t('DesireModule.permissions', 'Allow others to create new desires on your profile page');
        }
        return Yii::t('DesireModule.permissions', 'Allows the user to create desires');
    }

}
