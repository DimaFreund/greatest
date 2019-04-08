<?php

use humhub\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

//if ($messageId != "") {
//    $this->registerJs('loadMessage(' . Html::encode($messageId) . ');');
//}
?>
<div class="mailbox-wrapper">
<div class="page-content">
    <div class="content-wrap">
        <?= $this->render('_show', ['message' => $message, 'replyForm' => $replyForm]); ?>

    </div>
</div>
<aside class="right-side">
    <div class="right-sidebar msg-box-sidebar">
        <div class="panel-heading">

	        <?php $form = ActiveForm::begin(['id' => 'create-message-form', 'action' => Url::to(['/mail/mail/create'])  ]); ?>


		        <?php echo $form->errorSummary($newMessage); ?>

                <?php echo $form->field($newMessage, 'recipient', ['inputOptions' => ['id' => 'recipient']])->label(false); ?>

		        <?php
		        echo \humhub\modules\user\widgets\UserPicker::widget(array(
			        'inputId' => 'recipient',
			        'model' => $newMessage,
			        'attribute' => 'recipient',
			        'userGuid' => Yii::$app->user->guid,
			        'userSearchUrl' => Url::toRoute(['/mail/mail/search-user', 'keyword' => '-keywordPlaceholder-']),
			        'placeholderText' => Yii::t('MailModule.views_mail_create', 'Find user'),
			        'focus' => true,
		        ));
		        ?>

	        <?php ActiveForm::end(); ?>
        </div>

        <hr>
        <ul id="inbox" class="media-list">
		    <?php if (count($userMessages) != 0) : ?>
			    <?php foreach ($userMessages as $userMessage) : ?>
				    <?php echo $this->render('_messagePreview', array('userMessage' => $userMessage)); ?>
			    <?php endforeach; ?>
		    <?php else: ?>
                <li class="placeholder"><?php echo Yii::t('MailModule.views_mail_index', 'There are no messages yet.'); ?></li>
		    <?php endif; ?>
        </ul>
    </div>
</aside>
</div>