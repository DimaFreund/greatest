<?php
namespace humhub\modules\desire\models\forms;

use humhub\modules\blog\models\Blog;
use humhub\modules\desire\models\Desire;
use humhub\modules\news\models\News;
use humhub\modules\polls\models\Poll;
use humhub\modules\post\models\Post;
use humhub\modules\tags\models\Tags;
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

	public $keyword = '';
	public $page = 1;
	public $age_from;
	public $age_to;
	public $gender;
	public $country;
	public $kcountry;

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
			[['keyword','page'], 'safe'],
			[['gender', 'country'], 'string'],
			[['kcountry'], 'number'],
			[['age_from'], 'number', 'min' => 0],
			[['age_to'], 'number', 'max' => 120],
			['age_to', 'compare', 'compareAttribute' => 'age_from', 'operator' => '>=','type' => 'number']
		];
	}

	public function searchByTags() {

		$words = explode(' ', $this->keyword);
		$frequency = [];
		$elements = [];


		foreach ($words as $word) {
			$word = str_replace(',', '', $word);
			if(!empty($word)) {
				$tag = Tags::findOne( [ 'title' => $word ] );
				if ( isset( $tag ) && ! empty( $tag ) ) {
					foreach ( $tag->getFilterArticles($this) as $article ) {
						if ( isset( $article->id ) && ! empty( $frequency[ $article->id ] ) ) {
							$frequency[ $article->id ] ++;
						} else {
							$frequency[ $article->id ] = 1;
							$elements[ $article->id ]  = $article;
						}
					}
				}
			}
		}
		arsort($frequency);
		foreach ($frequency as $key=>$item) {
			$frequency[$key] = $elements[$key];
		}
		return $frequency;
	}

}
