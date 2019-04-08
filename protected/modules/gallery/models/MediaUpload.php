<?php

namespace humhub\modules\gallery\models;

/**
 * MediaUpload
 * 
 * @author Sebastian Stumpf
 */
class MediaUpload extends \humhub\modules\file\models\FileUpload
{

    /**
     * The supported extensions
     */
    public $validExtensions = ['png','jpeg','gif','jpg'];

    /**
     * @inheritdoc
     */
    public function rules()
    {
        $rules = [
            ['uploadedFile', 'file', 'extensions' => $this->validExtensions],
        ];
        return array_merge(parent::rules(), $rules);
    }

}
