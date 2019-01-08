<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2016 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\widgets;

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
class BaseLeftMenu extends \humhub\widgets\BaseMenu
{

	/**
	 * @var User
	 */
	public $user;

	/**
	 * @inheritdoc
	 */
	public $template = "@humhub/widgets/views/simpleMenu";


	public $id = 'left-menu-nav';

	/**
	 * @inheritdoc
	 */
	public function init()
	{
		$parameter = isset(Yii::$app->request->get('Category')['filter'][0])?Yii::$app->request->get('Category')['filter'][0]:'';


			$this->addItem([
				'label' => Yii::t('UserModule.widgets_ProfileMenuWidget', 'Home'),
				'url' => Url::to(['/dashboard']),
				'sortOrder' => 500,
				'isActive' => (Yii::$app->controller->module->id == 'dashboard'),
			]);

			$this->addItem([
				'label' => Yii::t('UserModule.widgets_ProfileMenuWidget', 'Success stories'),
				'url' => Url::to(['/blog/blog', 'Category[filter][]' => 100]),
				'sortOrder' => 500,
				'isActive' => (Yii::$app->controller->module->id == 'blog' && Yii::$app->controller->id == "blog" && Yii::$app->controller->action->id == "index" && $parameter == 100 ),
			]);

			$this->addItem([
				'label' => Yii::t('UserModule.widgets_ProfileMenuWidget', 'Desires'),
				'url' => Url::to(['/desire/desire/list']),
				'sortOrder' => 500,
				'isActive' => (Yii::$app->controller->module->id == 'desire' && Yii::$app->controller->id == "desire" && Yii::$app->controller->action->id == "list"),
			]);

			$this->addItem([
				'label' => Yii::t('UserModule.widgets_ProfileMenuWidget', 'Chat'),
				'url' => Url::toRoute(['/mail/chat']),
				'sortOrder' => 500,
				'isActive' => (Yii::$app->controller->id == "chat" && Yii::$app->controller->action->id == "index"),
			]);

			$this->addItem([
				'label' => Yii::t('UserModule.widgets_ProfileMenuWidget', 'Photos'),
				'url' => Url::toRoute(['/gallery/gallery/']),
				'sortOrder' => 500,
				'isActive' => (Yii::$app->controller->module->id == 'gallery' && Yii::$app->controller->id == "gallery" && Yii::$app->controller->action->id == "index"),
			]);

			$this->addItem([
				'label' => Yii::t('UserModule.widgets_ProfileMenuWidget', 'Blogs'),
				'url' => Url::toRoute(['/blog/blog/']),
				'sortOrder' => 500,
				'isActive' => (Yii::$app->controller->module->id == 'blog' && Yii::$app->controller->id == "blog" && Yii::$app->controller->action->id == "index" && $parameter != 100),
			]);

			$this->addItem([
				'label' => Yii::t('UserModule.widgets_ProfileMenuWidget', 'Groups'),
				'url' => Url::toRoute(['/space/list']),
				'sortOrder' => 500,
				'isActive' => (Yii::$app->controller->module->id == 'space' && Yii::$app->controller->id == "list" && Yii::$app->controller->action->id == "index"),
			]);

			$this->addItem([
				'label' => Yii::t('UserModule.widgets_ProfileMenuWidget', 'Polls'),
				'url' => Url::toRoute(['/polls/list']),
				'sortOrder' => 500,
				'isActive' => (Yii::$app->controller->module->id == 'polls' && Yii::$app->controller->id == "list"),
			]);

			$this->addItem([
				'label' => Yii::t('UserModule.widgets_ProfileMenuWidget', 'News'),
				'url' => Url::toRoute(['/news/news']),
				'sortOrder' => 500,
				'isActive' => (Yii::$app->controller->id == "manage" && Yii::$app->controller->action->id == "list"),
			]);



			parent::init();

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
