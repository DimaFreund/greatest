<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2015 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\desire\assets;

use yii\web\AssetBundle;

class DesireAsset extends AssetBundle
{

    public $sourcePath = '@desire/resources';
    public $css = [
    	'css/humhub.desire.css'
    ];
    public $js = [
        'js/humhub.desire.js'
    ];

    public $depends = [
        'humhub\assets\CoreApiAsset'
    ];

}
