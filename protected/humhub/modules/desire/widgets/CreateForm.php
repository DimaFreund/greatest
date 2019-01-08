<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2016 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\desire\widgets;

/**
 * This widget is used include the desire form.
 * It normally should be placed above a steam.
 *
 * @since 0.5
 */
class CreateForm extends \humhub\modules\content\widgets\WallCreateContentForm
{

    /**
     * @inheritdoc
     */
    public $submitUrl = '/desire/desire/desire';

    /**
     * @inheritdoc
     */
    public function renderForm()
    {
        return $this->render('form', array());
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        if (!$this->contentContainer->permissionManager->can(new \humhub\modules\desire\permissions\CreateDesire())) {
            return;
        }

        return parent::run();
    }

}

?>