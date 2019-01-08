<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2015 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\blog\assets;

use yii\web\AssetBundle;

class BlogAsset extends AssetBundle
{

    public $sourcePath = '@blog/resources';
    public $css = [
    	'css/humhub.blog.css'
    ];
    public $js = [
        'js/humhub.blog.js'
    ];

    public $depends = [
        'humhub\assets\CoreApiAsset'
    ];

}
