<?php

namespace humhub\modules\tags\widgets;

use wbraganca\tagsinput\TagsinputWidget;
use Yii;
use yii\helpers\Html;

class Tagsinput extends TagsinputWidget {

	public $clientOptions = [
		'trimValue'       => true,
		'allowDuplicates' => false,
		'maxChars'        => 15,
		'maxTags'         => 15,
	];

	public function run() {

		$this->registerClientScript();

		if ( Yii::$app->request->post( 'tags' ) ) {
			$value = Yii::$app->request->post( 'tags' );
		} else {

			$tags = $this->model->tags;

			$value = '';

			foreach ( $tags as $tag ) {
				$value .= $tag->title . ' ,';
			}
		}
		echo Html::textInput( 'tags', $value, $this->options );

	}

}