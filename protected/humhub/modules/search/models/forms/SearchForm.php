<?php
namespace humhub\modules\search\models\forms;

use humhub\modules\blog\models\Blog;
use humhub\modules\desire\models\Desire;
use humhub\modules\news\models\News;
use humhub\modules\polls\models\Poll;
use humhub\modules\post\models\Post;
use Yii;
use humhub\modules\user\models\User;
use humhub\modules\space\models\Space;
use \humhub\modules\search\engine\Search;

/**
 * Description of SearchForm
 *
 * @since 1.2
 * @author buddha
 */
class SearchForm extends \yii\base\Model
{
    const SCOPE_ALL = "all";
    const SCOPE_USER = "user";
    const SCOPE_SPACE = "space";
    const SCOPE_DESIRE = "desire";
    const SCOPE_BLOG = "blog";
    const SCOPE_NEWS = "news";
    const SCOPE_POST = "post";
    const SCOPE_CONTENT = "content";
    const SCOPE_POLL = "poll";
    
    public $keyword = '';
    public $scope = [];
    public $page = 1;
    public $limitSpaceGuids = [];
    
    public function init()
    {
        if(Yii::$app->request->get('page')) {
            $this->page = Yii::$app->request->get('page');
        }
    }
    
    
    /**
     * @inheritdoc
     */
    public function rules() 
    {
        return [
            [['keyword','scope','page','limitSpaceGuids'], 'safe']
        ];
    }
    
    public function getTotals($keyword, $options)
    {
        $totals = [];

        // Unset unnecessary search options
        unset($options['model'], $options['type'], $options['page'], $options['pageSize']);

        $searchResultSetCount = Yii::$app->search->find($keyword, array_merge($options, ['model' => User::className()]));
        $totals[self::SCOPE_USER] = $searchResultSetCount->total;
        $searchResultSetCount = Yii::$app->search->find($keyword, array_merge($options, ['model' => Space::className()]));
        $totals[self::SCOPE_SPACE] = $searchResultSetCount->total;
        $searchResultSetCount = Yii::$app->search->find($keyword, array_merge($options, ['model' => Blog::className()]));
        $totals[self::SCOPE_BLOG] = $searchResultSetCount->total;
        $searchResultSetCount = Yii::$app->search->find($keyword, array_merge($options, ['model' => Desire::className()]));
        $totals[self::SCOPE_DESIRE] = $searchResultSetCount->total;
        $searchResultSetCount = Yii::$app->search->find($keyword, array_merge($options, ['model' => News::className()]));
        $totals[self::SCOPE_NEWS] = $searchResultSetCount->total;
        $searchResultSetCount = Yii::$app->search->find($keyword, array_merge($options, ['model' => Post::className()]));
        $totals[self::SCOPE_POST] = $searchResultSetCount->total;
        $searchResultSetCount = Yii::$app->search->find($keyword, array_merge($options, ['model' => Poll::className()]));
        $totals[self::SCOPE_POLL] = $searchResultSetCount->total;

        $searchResultSetCount = Yii::$app->search->find($keyword, array_merge($options, ['type' => Search::DOCUMENT_TYPE_CONTENT]));
        $totals[self::SCOPE_CONTENT] = $searchResultSetCount->total;
        $totals[self::SCOPE_ALL] = $totals[self::SCOPE_CONTENT] + $totals[self::SCOPE_SPACE] + $totals[self::SCOPE_USER];

        return $totals;
    }
}
