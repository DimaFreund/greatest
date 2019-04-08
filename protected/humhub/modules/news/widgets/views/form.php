<?= humhub\widgets\RichtextField::widget([
   'id' =>  'contentForm_message',
   'placeholder' => Yii::t("NewsModule.widgets_views_newsForm", "What's on your mind?"),
    'name' => 'message',
    'disabled' => (property_exists(Yii::$app->controller, 'contentContainer') && Yii::$app->controller->contentContainer->isArchived()),
    'disabledText' => Yii::t("NewsModule.widgets_views_newsForm", "This space is archived."),
]);?>
