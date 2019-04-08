<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2016 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\news\widgets;

/**
 * This widget is used include the news form.
 * It normally should be placed above a steam.
 *
 * @since 0.5
 */
class CreateForm extends \humhub\modules\content\widgets\WallCreateContentForm
{

    /**
     * @inheritdoc
     */
    public $submitUrl = '/news/news/news';

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
        if (!$this->contentContainer->permissionManager->can(new \humhub\modules\news\permissions\CreateNews())) {
            return;
        }

        return parent::run();
    }

}

?>