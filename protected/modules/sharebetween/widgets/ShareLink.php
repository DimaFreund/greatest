<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2015 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\sharebetween\widgets;

use humhub\modules\content\models\Content;
use humhub\modules\sharebetween\models\Share;
use Yii;
use humhub\modules\content\components\ContentContainerController;

class ShareLink extends \yii\base\Widget
{

    /**
     * @var \humhub\modules\content\components\ContentActiveRecord
     */
    public $object;

    public $mode = 0;



    /**
     * Executes the widget.
     */
    public function run()
    {

	    // Yii::$app->assetManager->forceCopy = true;

		$objectId = $this->object->id;
		$objectModel = $this->object::className();
		$result = Content::findOne(array('object_model' => $objectModel, 'object_id' => $objectId));
		$id = $result->id;

       if ($this->object instanceof \humhub\modules\sharebetween\models\Share) {
	        $parent_id = $this->object->attributes['content_id'];
	       $count = Share::find()
	                     ->where(['content_id' => $parent_id])
	                     ->count();
	       return $this->render('shareLink', array(
		       'object' => $this->object,
		       'id' => $parent_id,
		       'count' => $count,
		       'mode' => $this->mode,
	       ));
       }
	    $count = Share::find()
	                  ->where(['content_id' => $id])
	                  ->count();

        return $this->render('shareLink', array(
                    'object' => $this->object,
                    'id' => $this->object->content->id,
                    'count' => $count,
	                'mode' => $this->mode,
        ));
    }

}
