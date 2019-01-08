<?php

namespace humhub\modules\sharebetween\models;

use Yii;
use humhub\modules\content\components\ContentActiveRecord;
use humhub\modules\content\models\Content;
use humhub\modules\content\components\ContentContainerActiveRecord;

class Share extends ContentActiveRecord
{

    public $wallEntryClass = 'humhub\modules\sharebetween\widgets\StreamEntry';
    public $autoAddToWall = true;

    public static function tableName()
    {
        return 'sharebetween_share';
    }

    public function objectName()
    {
    	return 'shared';
    }

    public function getTitle()
    {
    	$objectContent = $this->sharedContent->getPolymorphicRelation();
    	return $objectContent->objectName() . ' - <span>'.$objectContent->title.'</span>';
    }

    public function rules()
    {
        return array(
            [['content_id'], 'required'],
        );
    }

    public function getSharedContent()
    {
        return $this->hasOne(Content::className(), ['id' => 'content_id']);
    }

    public static function create(Content $content, ContentContainerActiveRecord $container)
    {

        $share = new self;
        $share->content_id = $content->id;
        $share->content->container = $container;
        $share->save();
    }

    public static function countShare(Content $content)
    {
        $count = Share::find()->where(['content_id' => $content->id])->count();

        return $count;
    }

    public static function deleteShare(Content $content)
    {
        $shares = Share::find()->joinWith('content')->where(['sharebetween_share.content_id' => $content->id])->all();
        foreach ($shares as $share) {
            $share->delete();
        }
    }
	public function getContentName()
	{
		return Yii::t('SharebetweenModule.share', "Share");
	}


}
