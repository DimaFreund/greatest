<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2015 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\desire\widgets;

/**
 * @inheritdoc
 */
class WallEntry extends \humhub\modules\content\widgets\WallEntry
{

    /**
     * @inheritdoc
     */
    public $editRoute = "/desire/desire/edit";

    /**
     * @inheritdoc
     */
    public function run()
    {
        return $this->render('wallEntry', array('desire' => $this->contentObject, 'justEdited' => $this->justEdited));
    }

}
