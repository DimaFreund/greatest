<?php

namespace humhub\modules\admin\models\forms;

use humhub\libs\DynamicConfig;
use Yii;


/**
 * BasicSettingsForm
 * @since 0.5
 */
class WelcomeSettingsForm extends \yii\base\Model
{

    public $totalRegisters;
    public $conceivedDesires;
    public $successStories;
    public $firstTestimonials;
    public $twoTestimonials;
    public $threeTestimonials;
    public $firstTestimonialsText;
    public $twoTestimonialsText;
    public $threeTestimonialsText;
    public $slides;
    public $imageTestimonials1;
    public $imageTestimonials2;
    public $imageTestimonials3;
    public $imageHowWork;
    public $successStoriesBackground;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $this->totalRegisters= Yii::$app->settings->get('totalRegisters');
        $this->conceivedDesires= Yii::$app->settings->get('conceivedDesires');
        $this->successStories= Yii::$app->settings->get('successStories');
        $this->firstTestimonials= Yii::$app->settings->get('firstTestimonials');
        $this->twoTestimonials= Yii::$app->settings->get('twoTestimonials');
        $this->threeTestimonials= Yii::$app->settings->get('threeTestimonials');
        $this->firstTestimonialsText= Yii::$app->settings->get('firstTestimonialsText');
        $this->twoTestimonialsText= Yii::$app->settings->get('twoTestimonialsText');
        $this->threeTestimonialsText= Yii::$app->settings->get('threeTestimonialsText');
        $this->slides= Yii::$app->settings->get('slides');
	    $this->imageTestimonials1= Yii::$app->settings->get('imageTestimonials1');
	    $this->imageTestimonials2= Yii::$app->settings->get('imageTestimonials2');
	    $this->imageTestimonials3= Yii::$app->settings->get('imageTestimonials3');
	    $this->imageHowWork= Yii::$app->settings->get('imageHowWork');
	    $this->successStoriesBackground= Yii::$app->settings->get('successStoriesBackground');

    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['totalRegisters', 'conceivedDesires', 'successStories'], 'required'],
            [['totalRegisters', 'conceivedDesires', 'successStories'], 'number', 'max' => 20000000000],
            [['firstTestimonials', 'twoTestimonials', 'threeTestimonials'], 'string', 'max' => 140],
	        [['firstTestimonialsText','twoTestimonialsText','threeTestimonialsText'], 'string', 'max' => 450],

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
        Yii::$app->settings->set('totalRegisters', $this->totalRegisters);
        Yii::$app->settings->set('conceivedDesires', $this->conceivedDesires);
        Yii::$app->settings->set('successStories', $this->successStories);
        Yii::$app->settings->set('firstTestimonials', $this->firstTestimonials);
        Yii::$app->settings->set('twoTestimonials', $this->twoTestimonials);
        Yii::$app->settings->set('threeTestimonials', $this->threeTestimonials);
        Yii::$app->settings->set('firstTestimonialsText', $this->firstTestimonialsText);
        Yii::$app->settings->set('twoTestimonialsText', $this->twoTestimonialsText);
        Yii::$app->settings->set('threeTestimonialsText', $this->threeTestimonialsText);
        Yii::$app->settings->set('slides', $this->slides);
        Yii::$app->settings->set('imageTestimonials1', $this->imageTestimonials1);
        Yii::$app->settings->set('imageTestimonials2', $this->imageTestimonials2);
        Yii::$app->settings->set('imageTestimonials3', $this->imageTestimonials3);
        Yii::$app->settings->set('imageHowWork', $this->imageHowWork);
        Yii::$app->settings->set('successStoriesBackground', $this->successStoriesBackground);




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
