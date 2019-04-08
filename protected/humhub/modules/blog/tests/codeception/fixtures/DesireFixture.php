<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2015 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\desire\tests\codeception\fixtures;

use yii\test\ActiveFixture;

class DesireFixture extends ActiveFixture
{

    public $modelClass = 'humhub\modules\desire\models\Desire';
    public $dataFile = '@modules/desire/tests/codeception/fixtures/data/desire.php';

}
