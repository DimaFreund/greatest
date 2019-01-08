<?php

namespace humhub\modules\sharebetween\controllers;

use Yii;
use humhub\modules\content\models\Content;
use humhub\modules\sharebetween\models\ShareForm;
use humhub\modules\sharebetween\models\Share;

class ShareController extends \humhub\components\Controller
{

    public function actionIndex()
    {
	    $this->forcePostRequest();

        $content = Content::findOne(['id' => Yii::$app->request->get('id')]);

        if (!$content->canView()) {
            throw new \yii\web\HttpException('400', 'Permission denied!');
        }

        Share::create($content, Yii::$app->user->getIdentity());

        $countShare = Share::countShare($content);

	    Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        return ["share" => true, "shareCounter" => $countShare];

    }

}
