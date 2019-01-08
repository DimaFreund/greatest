<?php

namespace humhub\modules\desire\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use humhub\modules\desire\models\Desire;


class DesireSearch extends Desire
{
	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['id'], 'integer'],
			[['title', 'message', 'greatest'], 'safe'],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function scenarios()
	{
		// bypass scenarios() implementation in the parent class
		return Model::scenarios();
	}

	/**
	 * Creates data provider instance with search query applied
	 *
	 * @param array $params
	 *
	 * @return ActiveDataProvider
	 */
	public function search($params)
	{
		$query = Desire::find();

		// add conditions that should always apply here

		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);

		$this->load($params);

		if (!$this->validate()) {
			// uncomment the following line if you do not want to return any records when validation fails
			// $query->where('0=1');
			return $dataProvider;
		}

		// grid filtering conditions
		$query->andFilterWhere([
			'id' => $this->id,
			'greatest' => $this->greatest,
		]);

		$query->andFilterWhere(['like', 'title', $this->title])
		      ->andFilterWhere(['like', 'message', $this->message]);

		return $dataProvider;
	}
}
