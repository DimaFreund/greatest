<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2017 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\widgets;

use Emojione\Client;
use Emojione\Ruleset;
use humhub\components\Widget;
use Yii;
use humhub\libs\Html;

/**
 * DatePicker
 *
 * @since 1.2.3
 * @author Luke
 */
class EmojiConvertToImage extends Widget
{

	public $content = '';

	/**
	 * @inheritdoc
	 */
	public function run() {

		$client = new Client(new Ruleset());

		return $client->toImage($this->content);

	}

}
