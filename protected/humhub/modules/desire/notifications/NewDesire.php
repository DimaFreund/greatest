<?php

namespace humhub\modules\desire\notifications;

use humhub\modules\content\interfaces\ContentOwner;
use Yii;
use yii\bootstrap\Html;
use humhub\modules\notification\components\BaseNotification;

class NewDesire extends BaseNotification
{

	/**
	 * @inheritdoc
	 */
	public $moduleId = 'desire';

	/**
	 * @inheritdoc
	 */
	public $viewName = 'newDesire';

	/**
	 * @inheritdoc
	 */
	public function category()
	{
		return new DesireNotificationCategory();
	}

	/**
	 * @inheritdoc
	 */
	public function getGroupKey()
	{
		$model = $this->getDesireRecord();
		return $model->className() . '-' . $model->getPrimaryKey();
	}

	/**
	 * @inheritdoc
	 */
	public function getMailSubject()
	{
		$contentInfo = '"'.$this->getDesireRecord()->title.'"';

		if ($this->groupCount > 1) {
			return Yii::t('DesireModule.notification', "{displayNames} likes your {contentTitle}.", [
				'displayNames' => strip_tags($this->getGroupUserDisplayNames()),
				'contentTitle' => $contentInfo
			]);
		}

		return Yii::t('DesireModule.notification', "{displayName} likes your {contentTitle}.", [
			'displayName' => Html::encode($this->originator->displayName),
			'contentTitle' => $contentInfo
		]);
	}

	public function getContentInfo( ContentOwner $content = null, $withContentName = true ) {
		return Html::tag('span', '"'.$content->title.'"');
	}

	public function getDesireReccord()
	{
		return $this->source->getPolyMorphicRelation();
	}

	/**
	 * @inheritdoc
	 */
	public function html()
	{
		$contentInfo = $this->getContentInfo($this->getDesireRecord());

		if ($this->groupCount > 1) {
			return Yii::t('DesireModule.notification', "{displayNames} add new desire {contentTitle}.", [
				'displayNames' => $this->getGroupUserDisplayNames(),
				'contentTitle' => $contentInfo
			]);
		}

		return Yii::t('DesireModule.notification', "{displayName} add new desire {contentTitle}.", [
			'displayName' => Html::tag('strong', Html::encode($this->originator->displayName)),
			'contentTitle' => $contentInfo
		]);
	}

	/**
	 * The liked record
	 *
	 * @return \humhub\components\ActiveRecord
	 */
	protected function getDesireRecord()
	{
		return $this->source->getSource();
	}

}
