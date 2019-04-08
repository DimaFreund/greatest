<?php
namespace humhub\modules\tags\models;

use humhub\components\ActiveRecord;
use humhub\modules\desire\models\Desire;
use humhub\modules\user\models\Profile;

class Tags extends ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'tags';
	}
	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['title'], 'string', 'max' => 255],
		];
	}
	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'title' => 'Title',
		];
	}
	/**
	 * @return \yii\db\ActiveQuery
	 */

	public function getArticles()
	{
		return $this->hasMany(Desire::className(), ['id' => 'desire_id'])
		            ->viaTable('tags_relationship', ['tags_id' => 'id']);
	}

	public function getFilterArticles($options = null)
	{
		$desire = Desire::find();
		$desire->leftJoin('tags_relationship', 'desire.id = tags_relationship.desire_id');
		$desire->leftJoin('profile', 'desire.created_by = profile.user_id');
		$desire->where(['tags_relationship.tags_id' => $this->id]);
		$this->customFilterSearch($desire, $options);
//		$desire->andWhere(['profile.gender' => 'male']);
		return $desire->all();
	}

	protected function customFilterSearch($request, $options)
	{
		if(isset($options->gender) && !empty($options->gender)) {
			$request->andWhere(['profile.gender' => $options->gender]);
		}
		if(isset($options->age_from) && !empty($options->age_from)) {
			$age_from = $options->age_from;
			$date_from = date("Y-m-d", strtotime("-$age_from year"));
			$request->andWhere(['<', 'profile.birthday', $date_from]);
		}
		if(isset($options->age_to) && !empty($options->age_to)) {
			$age_to = $options->age_to+1;
			$date_to = date("Y-m-d", strtotime("-$age_to year"));
			$request->andWhere(['>', 'profile.birthday', $date_to]);
		}
		if(isset($options->country) && !empty($options->country)) {
			$key = array_search(strtolower($options->country), array_map('strtolower', (new Profile)->getOptionsField('country')));
			$request->andWhere(['profile.country' => $key]);
		}

		return $request;
	}


	/**
	 * Returns static class instance, which can be used to obtain meta information.
	 *
	 * @param bool $refresh whether to re-create static instance even, if it is already cached.
	 *
	 * @return static class instance.
	 */
	public static function instance( $refresh = false ) {
		// TODO: Implement instance() method.
}}