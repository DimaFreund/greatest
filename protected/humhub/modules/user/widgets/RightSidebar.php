<?php
/**
 * Created by PhpStorm.
 * User: work
 * Date: 09.02.18
 * Time: 13:08
 */

namespace humhub\modules\user\widgets;



use humhub\modules\blog\models\Blog;
use humhub\modules\friendship\models\Friendship;
use humhub\modules\gallery\models\Media;
use humhub\modules\news\models\News;
use humhub\modules\polls\models\Poll;
use humhub\modules\space\models\Membership;
use humhub\modules\space\models\Space;
use humhub\modules\user\models\User;
use Yii;

class RightSidebar extends \yii\base\Widget
{


	public function run()
	{
		$user = \Yii::$app->user->getIdentity();

		$userInfo = $user->profile;

		$friends = Friendship::getPartFriends($user, 0, 4);

		$blogs = Blog::getUserBlog($user, 3);

		$media = new Media();

		$media = $media->getMyLastPhoto($user,9);

		$spaces = Membership::getUserSpaceLast($user, 3);

		$polls = Poll::getUserLastPoll($user, 2);

		$cacheId = 'global_statistic_info';

		$statistic = Yii::$app->cache->get($cacheId);

		if(!$statistic) {
			$statistic = $this->getStatistic();
			Yii::$app->cache->set( $cacheId, $statistic, Yii::$app->settings->get( 'cache.expireTime' ) );
		}

		$renderId = "right_sidebar_render";

		$render = Yii::$app->cache->get($renderId);

		if(!$render) {
			$statistic = $this->getStatistic();
			Yii::$app->cache->set( $renderId, $render, 3600);
		}

		$render = $this->render('rightSidebar', [
			'user' => $user,
			'userInfo' => $userInfo,
			'friends' => $friends,
			'blogs' => $blogs,
			'media' => $media,
			'spaces' => $spaces,
			'polls' => $polls,
			'statistic' => $statistic,
		]);

		return $render;
	}


	private function getStatistic()
	{

		$result['members'] = User::find()->count();
		$result['blogs'] = Blog::find()->count();
		$result['polls'] = Poll::find()->count();
		$result['news'] = News::find()->count();
		$result['groups'] = Space::find()->count();
		$result['photos'] = Media::find()->count();

		return $result;
	}


}