<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2015 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\news\assets;

use yii\web\AssetBundle;

class NewsAsset extends AssetBundle
{

    public $sourcePath = '@news/resources';
    public $css = [
    	'css/humhub.news.css'
    ];
    public $js = [
        'js/humhub.news.js'
    ];

    public $depends = [
        'humhub\assets\CoreApiAsset'
    ];

}
