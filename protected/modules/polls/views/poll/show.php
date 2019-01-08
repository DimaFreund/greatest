

<?php

echo \humhub\modules\polls\widgets\WallCreateForm::widget([
    'contentContainer' => $contentContainer,
    'submitButtonText' => Yii::t('PollsModule.widgets_PollFormWidget', 'Ask'),
]);
?>
    <div class="content-wrap">
<?php

$canCreatePolls = $contentContainer->permissionManager->can(new \humhub\modules\polls\permissions\CreatePoll());


echo \humhub\modules\stream\widgets\StreamViewer::widget(array(
    'contentContainer' => $contentContainer,
    'streamAction' => '/polls/poll/stream',
    'messageStreamEmpty' => ($canCreatePolls) ?
            Yii::t('PollsModule.widgets_views_stream', '<b>There are no polls yet!</b><br>Be the first and create one...') :
            Yii::t('PollsModule.widgets_views_stream', '<b>There are no polls yet!</b>'),
    'messageStreamEmptyCss' => ($canCreatePolls) ? 'placeholder-empty-stream' : '',
    'showFilters' => false,
));
?>

    </div>
