<?= humhub\widgets\RichtextField::widget([
   'id' =>  'contentForm_message',
   'placeholder' => Yii::t("BlogModule.widgets_views_blogForm", "What's on your mind?"),
    'name' => 'message',
    'disabled' => (property_exists(Yii::$app->controller, 'contentContainer') && Yii::$app->controller->contentContainer->isArchived()),
    'disabledText' => Yii::t("BlogModule.widgets_views_blogForm", "This space is archived."),
]);?>
