<?php

namespace humhub\modules\admin\models\forms;

use humhub\libs\DynamicConfig;
use Yii;


/**
 * BasicSettingsForm
 * @since 0.5
 */
class PagesInfoForm extends \yii\base\Model
{

	public $anetwork;
	public $conditions;
	public $policy;
	public $faq;
	/**
	 * @inheritdoc
	 */
	public function init()
	{
		parent::init();

		$this->anetwork= Yii::$app->settings->get('anetwork');
		$this->conditions= Yii::$app->settings->get('conditions');
		$this->policy= Yii::$app->settings->get('policy');
		$this->faq= Yii::$app->settings->get('faq');

	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['anetwork', 'policy', 'conditions', 'faq'], 'string'],
		];
	}

	/**
	 * @inheritdoc
	 */
//    public function attributeLabels()
//    {
//        return [
//            'name' => Yii::t('AdminModule.forms_BasicSettingsForm', 'Name of the application'),
//            'baseUrl' => Yii::t('AdminModule.forms_BasicSettingsForm', 'Base URL'),
//            'defaultLanguage' => Yii::t('AdminModule.forms_BasicSettingsForm', 'Default language'),
//            'timeZone' => Yii::t('AdminModule.forms_BasicSettingsForm', 'Server Timezone'),
//            'defaultSpaceGuid' => Yii::t('AdminModule.forms_BasicSettingsForm', 'Default space'),
//            'tour' => Yii::t('AdminModule.forms_BasicSettingsForm', 'Show introduction tour for new users'),
//            'dashboardShowProfilePostForm' => Yii::t('AdminModule.forms_BasicSettingsForm',
//                'Show user profile post form on dashboard'),
//            'enableFriendshipModule' => Yii::t('AdminModule.forms_BasicSettingsForm', 'Enable user friendship system'),
//            'defaultStreamSort' => Yii::t('AdminModule.forms_BasicSettingsForm', 'Default stream content order'),
//        ];
//    }

	/**
	 * This validator function checks the defaultSpaceGuid.
	 * @param type $attribute
	 * @param type $params
	 */
//    public function checkSpaceGuid($attribute, $params)
//    {
//        if (!empty($this->defaultSpaceGuid)) {
//            foreach ($this->defaultSpaceGuid as $spaceGuid) {
//                if ($spaceGuid != "") {
//                    $space = \humhub\modules\space\models\Space::findOne(['guid' => $spaceGuid]);
//                    if ($space == null) {
//                        $this->addError($attribute, Yii::t('AdminModule.forms_BasicSettingsForm', "Invalid space"));
//                    }
//                }
//            }
//        }
//    }

	/**
	 * Saves the form
	 * @return boolean
	 */
	public function save()
	{

		Yii::$app->settings->set('anetwork', $this->anetwork);
		Yii::$app->settings->set('conditions', $this->conditions);
		Yii::$app->settings->set('policy', $this->policy);
		Yii::$app->settings->set('faq', $this->faq);




		DynamicConfig::rewrite();

		return true;
	}


	/**
	 * Returns available options for defaultStreamSort attribute
	 * @return array
	 */
	public function getDefaultStreamSortOptions()
	{
		return [
			Stream::SORT_CREATED_AT => Yii::t('AdminModule.forms_BasicSettingsForm', 'Sort by creation date'),
			Stream::SORT_UPDATED_AT => Yii::t('AdminModule.forms_BasicSettingsForm', 'Sort by update date'),
		];
	}

}
