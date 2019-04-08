<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2017 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\controllers;

use Yii;
use yii\web\HttpException;
use yii\base\UserException;
use humhub\components\Controller;

/**
 * ErrorController
 *
 * @author luke
 * @since 0.11
 */
class ErrorController extends Controller
{

	public $layout = "@humhub/modules/user/views/layouts/main";
    /**
     * This is the action to handle external exceptions.
     */
    public function actionIndex()
    {
        if (($exception = Yii::$app->getErrorHandler()->exception) === null) {
            return '';
        }
	    Yii::$app->params['class_body'] = 'front-header';

        if ($exception instanceof UserException || $exception instanceof HttpException) {
            $message = $exception->getMessage();
        } else {
            $message = Yii::t('error', 'An internal server error occurred.');
        }

        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = 'json';
            return [
                'error' => true,
                'message' => $message
            ];
        }

        /**
         * Show special login required view for guests
         */
        if (Yii::$app->user->isGuest && $exception instanceof HttpException) {
            return $this->render('@humhub/views/error/401_guests', ['message' => $message]);
        }

        return $this->render('@humhub/views/error/index', [
            'message' => $message
        ]);
    }

}
