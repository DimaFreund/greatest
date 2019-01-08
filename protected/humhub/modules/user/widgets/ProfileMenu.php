<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2016 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\user\widgets;

use Yii;
use humhub\modules\user\models\User;
use humhub\modules\user\permissions\ViewAboutPage;
use yii\helpers\Url;

/**
 * ProfileMenuWidget shows the (usually left) navigation on user profiles.
 *
 * Only a controller which uses the 'application.modules_core.user.ProfileControllerBehavior'
 * can use this widget.
 *
 * The current user can be gathered via:
 *  $user = Yii::$app->getController()->getUser();
 *
 * @since 0.5
 * @author Luke
 */
class ProfileMenu extends \humhub\widgets\BaseMenu
{

    /**
     * @var User
     */
    public $user;

    /**
     * @inheritdoc
     */
    public $template = "@humhub/modules/user/widgets/views/topProfileNavigation";

    /**
     * @inheritdoc
     */
    public function init()
    {

        if ($this->user->permissionManager->can(new ViewAboutPage())) {
            $this->addItem([
                'label' => Yii::t('UserModule.widgets_ProfileMenuWidget', 'Timeline'),
                'url' => $this->user->createUrl('//user/profile/home'),
                'sortOrder' => 200,
                'isActive' => (Yii::$app->controller->id == "profile" && (Yii::$app->controller->action->id == "index" || Yii::$app->controller->action->id == "home")),
            ]);


            $this->addItem([
                'label' => Yii::t('UserModule.widgets_ProfileMenuWidget', 'Info'),
                'url' => $this->user->createUrl('//user/profile/about'),
                'sortOrder' => 300,
                'isActive' => (Yii::$app->controller->id == "profile" && Yii::$app->controller->action->id == "about"),
            ]);

            $this->addItem([
                'label' => Yii::t('UserModule.widgets_ProfileMenuWidget', 'Desires'),
                'url' => $this->user->createUrl('//user/profile/desires'),
                'sortOrder' => 400,
                'isActive' => (Yii::$app->controller->id == "profile" && ( Yii::$app->controller->action->id == "desires" || Yii::$app->controller->action->id == "desire-one")),
            ]);

            $this->addItem([
                'label' => Yii::t('UserModule.widgets_ProfileMenuWidget', 'Friends'),
                'url' => Url::toRoute(['/friendship/manage/list', 'id' => $this->user->id]),
                'sortOrder' => 500,
                'isActive' => (Yii::$app->controller->id == "manage" && Yii::$app->controller->action->id == "list"),
            ]);

            $this->addItem([
                'label' => Yii::t('UserModule.widgets_ProfileMenuWidget', 'Blog'),
                'url' => $this->user->createUrl('//user/profile/blog'),
                'sortOrder' => 600,
                'isActive' => (Yii::$app->controller->id == "profile" && ( Yii::$app->controller->action->id == "blog")),
            ]);

            $this->addItem([
                'label' => Yii::t('UserModule.widgets_ProfileMenuWidget', 'Success stories'),
                'url' => $this->user->createUrl('//user/profile/success-stories'),
                'sortOrder' => 600,
                'isActive' => (Yii::$app->controller->id == "profile" && ( Yii::$app->controller->action->id == "success-stories" || Yii::$app->controller->action->id == "success-stories-one")),
            ]);

	        $this->addItem([
		        'label' => Yii::t('GalleryModule.base', 'Photos'),
		        'url' => $this->user->createUrl('//gallery/list'),
		        'sortOrder' => 700,
		        'isActive' => (Yii::$app->controller->id == "list" && (Yii::$app->controller->action->id == "index" || Yii::$app->controller->action->id == "photos" || Yii::$app->controller->action->id == 'photo-one'))
	        ]);

            $this->addItem([
                'label' => Yii::t('UserModule.widgets_ProfileMenuWidget', 'Groups'),
                'url' => $this->user->createUrl('//user/profile/space-membership-list'),
                'sortOrder' => 800,
                'isActive' => (Yii::$app->controller->id == "profile" && Yii::$app->controller->action->id == "groups"),
            ]);

            $this->addItem([
                'label' => Yii::t('UserModule.widgets_ProfileMenuWidget', 'Polls'),
                'url' => $this->user->createUrl('//user/profile/polls'),
                'sortOrder' => 900,
                'isActive' => (Yii::$app->controller->id == "profile" && Yii::$app->controller->action->id == "polls"),
            ]);


            parent::init();

        }
    }



    /**
     * @inheritdoc
     */
    public function run()
    {
        if (Yii::$app->user->isGuest && $this->user->visibility != User::VISIBILITY_ALL) {
            return;
        }

        return parent::run();
    }

}

?>
