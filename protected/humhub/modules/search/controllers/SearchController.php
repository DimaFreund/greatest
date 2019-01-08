<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2017 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\search\controllers;

use humhub\components\GeneralController;
use humhub\modules\blog\models\Blog;
use humhub\modules\desire\models\Desire;
use humhub\modules\news\models\News;
use humhub\modules\polls\models\Poll;
use humhub\modules\post\models\Post;
use Yii;
use humhub\modules\space\models\Space;
use humhub\modules\user\models\User;
use humhub\modules\search\models\forms\SearchForm;
use humhub\modules\space\widgets\Image;

/**
 * Search Controller provides search functions inside the application.
 *
 * @author Luke
 * @since 0.12
 */
class SearchController extends GeneralController
{

    /**
     * @var string the current search keyword
     */
    public static $keyword = null;

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->appendPageTitle(\Yii::t('SearchModule.base', 'Search'));
        return parent::init();
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'acl' => [
                'class' => \humhub\components\behaviors\AccessControl::className(),
                'guestAllowedActions' => ['index']
            ]
        ];
    }

    public function actionIndex()
    {
        $model = new SearchForm();
        $model->load(Yii::$app->request->get());
        $request = Yii::$app->request->get('scope');
        if(isset($request) && !empty($request)) {
	        $model->scope = Yii::$app->request->get( 'scope' );
        }
            $limitSpaces = [];
        if (!empty($model->limitSpaceGuids)) {
            foreach ($model->limitSpaceGuids as $guid) {
                $space = Space::findOne(['guid' => trim($guid)]);
                if ($space !== null) {
                    $limitSpaces[] = $space;
                }
            }
        }

        $options = [
            'page' => $model->page,
            'sort' => (empty($model->keyword)) ? 'title' : null,
            'pageSize' => Yii::$app->settings->get('paginationSize'),
            'limitSpaces' => $limitSpaces
        ];



        if (array_key_exists(SearchForm::SCOPE_SPACE, $model->scope)) {
	        $options['model'][] = Space::className();
        }
        if (array_key_exists(SearchForm::SCOPE_USER, $model->scope)) {
	        $options['model'][] = User::className();
        }
        if (array_key_exists(SearchForm::SCOPE_BLOG, $model->scope)) {
	        $options['model'][] = Blog::className();
        }
        if (array_key_exists(SearchForm::SCOPE_DESIRE, $model->scope)) {
	        $options['model'][] = Desire::className();
        }
        if (array_key_exists(SearchForm::SCOPE_NEWS, $model->scope)) {
	        $options['model'][] = News::className();
        }
        if (array_key_exists(SearchForm::SCOPE_POST, $model->scope)) {
        	$options['model'][] = Post::className();
        }
        if (array_key_exists(SearchForm::SCOPE_POLL, $model->scope)) {
        	$options['model'][] = Poll::className();
        }
        if (empty($options['model'])) {
            $model->scope = [SearchForm::SCOPE_ALL];
        }

        $searchResultSet = Yii::$app->search->find($model->keyword, $options);

        // store static for use in widgets (e.g. fileList)
        self::$keyword = $model->keyword;

        $pagination = new \yii\data\Pagination;
        $pagination->totalCount = $searchResultSet->total;
        $pagination->pageSize = $searchResultSet->pageSize;

        return $this->render('index', array(
                    'model' => $model,
                    'results' => $searchResultSet->getResultInstances(),
                    'pagination' => $pagination,
                    'totals' => $model->getTotals($model->keyword, $options),
                    'limitSpaces' => $limitSpaces
        ));
    }

    /**
     * JSON Search interface for Mentioning
     */
    public function actionMentioning()
    {
        \Yii::$app->response->format = 'json';

        $results = array();
        $keyword = Yii::$app->request->get('keyword', "");

        $searchResultSet = Yii::$app->search->find($keyword, [
            'model' => array(User::className(), Space::className()),
            'pageSize' => 10
        ]);

        foreach ($searchResultSet->getResultInstances() as $container) {
            $results[] = array(
                'guid' => $container->guid,
                'type' => ($container instanceof Space) ? "s" : "u",
                'name' => $container->getDisplayName(),
                'image' => ($container instanceof Space) ? Image::widget(['space' => $container, 'width' => 20]) : "<img class='img-rounded' src='" . $container->getProfileImage()->getUrl() . "' height='20' width='20' alt=''>",
                'link' => $container->getUrl()
            );
        };

        return $results;
    }

}
