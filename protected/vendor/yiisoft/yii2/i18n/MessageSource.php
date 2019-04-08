<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace yii\i18n;

use humhub\libs\CURLHelper;
use Yii;
use yii\base\Component;
use yii\db\Exception;

/**
 * MessageSource is the base class for message translation repository classes.
 *
 * A message source stores message translations in some persistent storage.
 *
 * Child classes should override [[loadMessages()]] to provide translated messages.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class MessageSource extends Component
{
    /**
     * @event MissingTranslationEvent an event that is triggered when a message translation is not found.
     */
    const EVENT_MISSING_TRANSLATION = 'missingTranslation';

    /**
     * @var bool whether to force message translation when the source and target languages are the same.
     * Defaults to false, meaning translation is only performed when source and target languages are different.
     */
    public $forceTranslation = false;
    /**
     * @var string the language that the original messages are in. If not set, it will use the value of
     * [[\yii\base\Application::sourceLanguage]].
     */
    public $sourceLanguage;

    private $_messages = [];


    /**
     * Initializes this component.
     */
    public function init()
    {
        parent::init();
        if ($this->sourceLanguage === null) {
            $this->sourceLanguage = Yii::$app->sourceLanguage;
        }
    }

    /**
     * Loads the message translation for the specified language and category.
     * If translation for specific locale code such as `en-US` isn't found it
     * tries more generic `en`.
     *
     * @param string $category the message category
     * @param string $language the target language
     * @return array the loaded messages. The keys are original messages, and the values
     * are translated messages.
     */
    protected function loadMessages($category, $language)
    {
        return [];
    }

    /**
     * Translates a message to the specified language.
     *
     * Note that unless [[forceTranslation]] is true, if the target language
     * is the same as the [[sourceLanguage|source language]], the message
     * will NOT be translated.
     *
     * If a translation is not found, a [[EVENT_MISSING_TRANSLATION|missingTranslation]] event will be triggered.
     *
     * @param string $category the message category
     * @param string $message the message to be translated
     * @param string $language the target language
     * @return string|bool the translated message or false if translation wasn't found or isn't required
     */
    public function translate($category, $message, $language)
    {
        if ($this->forceTranslation || $language !== $this->sourceLanguage) {
            return $this->translateMessage($category, $message, $language);
        } else {
            return false;
        }
    }

    /**
     * Translates the specified message.
     * If the message is not found, a [[EVENT_MISSING_TRANSLATION|missingTranslation]] event will be triggered.
     * If there is an event handler, it may provide a [[MissingTranslationEvent::$translatedMessage|fallback translation]].
     * If no fallback translation is provided this method will return `false`.
     * @param string $category the category that the message belongs to.
     * @param string $message the message to be translated.
     * @param string $language the target language.
     * @return string|bool the translated message or false if translation wasn't found.
     */
    protected function translateMessage($category, $message, $language)
    {
        $key = $language . '/' . $category;
        if (!isset($this->_messages[$key])) {
            $this->_messages[$key] = $this->loadMessages($category, $language);
        }
        if (isset($this->_messages[$key][$message]) && $this->_messages[$key][$message] != '') {
            return $this->_messages[$key][$message];
        } elseif ($this->hasEventHandlers(self::EVENT_MISSING_TRANSLATION)) {
            $event = new MissingTranslationEvent([
                'category' => $category,
                'message' => $message,
                'language' => $language,
            ]);
            $this->trigger(self::EVENT_MISSING_TRANSLATION, $event);
            if ($event->translatedMessage !== null) {
                return $this->_messages[$key][$message] = $event->translatedMessage;
            }
        }

        if((isset(Yii::$app->controller->id) && Yii::$app->controller->id != 'translate' && Yii::$app->user->id == 1 && $language != 'en-US')) { //TODO Important remove before production
	        $messages             = $this->_messages[ $key ];
//	        try {
//	        	$url = "https://translate.googleapis.com/translate_a/single?client=gtx&sl=auto&tl=$language&dt=t&q=" . urlencode($message);
////	        	$result = file_get_contents($url);
//
//		        $http = new \Zend\Http\Client($url, [
//			        'adapter' => '\Zend\Http\Client\Adapter\Curl',
//			        'curloptions' => CURLHelper::getOptions(),
//			        'timeout' => 30
//		        ]);
//
//		        $response = $http->send();
//		        $result = $response->getBody();
//
//				$result = json_decode($result);
//	        	$translate = $result[0][0][0];
//	        } catch (Exception $e) {
//	        	$translate = '';
//	        }
	        $translate = "";
	        $messages[ $message ] = $translate;
	        asort( $messages );
	        $array   = str_replace( "\r", '', var_export( $messages, true ) );
	        $file    = $this->getMessageFilePath( $category, $language );
	        $content = <<<EOD
<?php
return $array;

EOD;

	        file_put_contents( $file, $content );

        }
//        return '----';
        return $this->_messages[$key][$message] = false;
    }
}
