<?= humhub\widgets\RichtextField::widget([
   'id' =>  'contentForm_message',
   'placeholder' => Yii::t("DesireModule.widgets_views_desireForm", "What's on your mind?"),
    'name' => 'message',
    'disabled' => (property_exists(Yii::$app->controller, 'contentContainer') && Yii::$app->controller->contentContainer->isArchived()),
    'disabledText' => Yii::t("DesireModule.widgets_views_desireForm", "This space is archived."),
]);?>
