<?php

namespace humhub\modules\news\notifications;

use humhub\modules\content\interfaces\ContentOwner;
use Yii;
use yii\bootstrap\Html;
use humhub\modules\notification\components\BaseNotification;

class NewNews extends BaseNotification
{

	/**
	 * @inheritdoc
	 */
	public $moduleId = 'news';

	/**
	 * @inheritdoc
	 */
	public $viewName = 'newNews';

	/**
	 * @inheritdoc
	 */
	public function category()
	{
		return new NewsNotificationCategory();
	}

	/**
	 * @inheritdoc
	 */
	public function getGroupKey()
	{
		$model = $this->getNewsRecord();
		return $model->className() . '-' . $model->getPrimaryKey();
	}

	/**
	 * @inheritdoc
	 */
	public function getMailSubject()
	{
		$contentInfo = '"'.$this->getNewsRecord()->title.'"';

		if ($this->groupCount > 1) {
			return Yii::t('NewsModule.notification', "{displayNames} likes your {contentTitle}.", [
				'displayNames' => strip_tags($this->getGroupUserDisplayNames()),
				'contentTitle' => $contentInfo
			]);
		}

		return Yii::t('NewsModule.notification', "{displayName} likes your {contentTitle}.", [
			'displayName' => Html::encode($this->originator->displayName),
			'contentTitle' => $contentInfo
		]);
	}

	public function getContentInfo( ContentOwner $content = null, $withContentName = true ) {
		return Html::tag('span', '"'.$content->title.'"');
	}

	public function getNewsReccord()
	{
		return $this->source->getPolyMorphicRelation();
	}

	/**
	 * @inheritdoc
	 */
	public function html()
	{
		$contentInfo = $this->getContentInfo($this->getNewsRecord());

		if ($this->groupCount > 1) {
			return Yii::t('NewsModule.notification', "{displayNames} add new news {contentTitle}.", [
				'displayNames' => $this->getGroupUserDisplayNames(),
				'contentTitle' => $contentInfo
			]);
		}

		return Yii::t('NewsModule.notification', "{displayName} add new news {contentTitle}.", [
			'displayName' => Html::tag('strong', Html::encode($this->originator->displayName)),
			'contentTitle' => $contentInfo
		]);
	}

	/**
	 * The liked record
	 *
	 * @return \humhub\components\ActiveRecord
	 */
	protected function getNewsRecord()
	{
		return $this->source->getSource();
	}

}
