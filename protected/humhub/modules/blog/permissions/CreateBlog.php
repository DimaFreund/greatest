<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2015 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\blog\permissions;

use Yii;
use humhub\modules\user\models\User;
use humhub\modules\space\models\Space;

/**
 * CreateBlog Permission
 */
class CreateBlog extends \humhub\libs\BasePermission
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
    protected $moduleId = 'blog';

    /**
     * @inheritdoc
     */
    public function getTitle()
    {
        return Yii::t('BlogModule.permissions', 'Create blog');
    }

    /**
     * @inheritdoc
     */
    public function getDescription()
    {
        if ($this->contentContainer instanceof User) {
            return Yii::t('BlogModule.permissions', 'Allow others to create new blogs on your profile page');
        }
        return Yii::t('BlogModule.permissions', 'Allows the user to create blogs');
    }

}
