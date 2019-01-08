<?php

use humhub\modules\file\handler\FileHandlerCollection;
use humhub\modules\file\widgets\ShowFiles;
use yii\helpers\Html;
use yii\helpers\Url;
use humhub\widgets\ModalConfirm;
use humhub\widgets\TimeAgo;
use humhub\compat\CActiveForm;

?>
<div class="panel panel-default msg-box">

	<?php if ( $message == null ) { ?>

        <div class="panel-body">
			<?php echo Yii::t( 'MailModule.views_mail_show', 'There are no messages yet.' ); ?>
        </div>
	<?php } else { ?>

    <div class="panel-heading">
		<?php echo Html::encode( $message->title ); ?>


		<?php if ( count( $message->users ) != 0 ) : ?>

			<?php foreach ( $message->anotherUsers as $user ) : ?>
                <a href="<?php echo $user->getUrl(); ?>">
                    <img src="<?php echo $user->getProfileImage()->getUrl(); ?>"
                         class="img-rounded tt img_margin" height="29" width="29"
                         data-toggle="tooltip" data-placement="top" title=""
                         data-original-title="<?php echo Html::encode( $user->displayName ); ?>">
                    <span class="name-user"><?= $user->displayName; ?></span>
                </a>
			<?php endforeach; ?>

            <div class="pull-right">
                <div class="sub-context-menu">
                    <div class="context-menu-btn"><span></span><span></span><span></span></div>
                    <ul class="context-menu">
                        <li>
	                    <?php if ( count( $message->users ) != 1 ) : ?>
		                    <?php
		                    echo ModalConfirm::widget( array(
			                    'uniqueID'        => 'modal_leave_conversation_' . $message->id,
			                    'title'           => Yii::t( 'MailModule.views_mail_show', '<strong>Confirm</strong> leaving conversation' ),
			                    'message'         => Yii::t( 'MailModule.views_mail_show', 'Do you really want to leave this conversation?' ),
			                    'buttonTrue'      => Yii::t( 'MailModule.views_mail_show', 'Leave' ),
			                    'buttonFalse'     => Yii::t( 'MailModule.views_mail_show', 'Cancel' ),
			                    'linkContent'     => '<i class="fa fa-sign-out"></i> '. Yii::t( 'MailModule.views_mail_show', 'Leave' ),
			                    'linkTooltipText' => Yii::t( 'MailModule.views_mail_show', 'Leave conversation' ),
			                    'linkHref'        => Url::to( [ "/mail/mail/leave", 'id' => $message->id ] )
		                    ) );
		                    ?>
	                    <?php endif; ?>
	                    <?php if ( count( $message->users ) == 1 ) : ?>
		                    <?php
		                    echo ModalConfirm::widget( array(
			                    'uniqueID'        => 'modal_leave_conversation_' . $message->id,
			                    'title'           => Yii::t( 'MailModule.views_mail_show', '<strong>Confirm</strong> deleting conversation' ),
			                    'message'         => Yii::t( 'MailModule.views_mail_show', 'Do you really want to delete this conversation?' ),
			                    'buttonTrue'      => Yii::t( 'MailModule.views_mail_show', 'Delete' ),
			                    'buttonFalse'     => Yii::t( 'MailModule.views_mail_show', 'Cancel' ),
			                    'linkContent'     => '<i class="fa fa-times"></i> '. Yii::t( 'MailModule.views_mail_show', 'Delete' ),
			                    'linkTooltipText' => Yii::t( 'MailModule.views_mail_show', 'Delete conversation' ),
			                    'linkHref'        => Url::to( [ "/mail/mail/leave", 'id' => $message->id ] )
		                    ) );
		                    ?>
	                    <?php endif; ?>
                        </li>
                        <li>
	                        <?php
	                        echo Html::a( '<i class="fa fa-plus"></i> ' . Yii::t( 'MailModule.views_mail_show', 'Add user' ), [
		                        '/mail/mail/add-user',
		                        'id'   => $message->id,
		                        'ajax' => 1
	                        ], array(
		                        'data-target' => '#globalModal'
	                        ) );
	                        ?>
                        </li>
                    </ul>
                </div>


            </div>
		<?php endif; ?>
    </div>


    <div class="panel-body">

        <hr style="margin-top: 0;">

        <ul id="entry-messadge-content" class="media-list" style="max-height: 551px; overflow-y: scroll;">
            <!-- BEGIN: Results -->
			<?php foreach ( $message->entries as $entry ) : ?>
                <div class="media <?php if ( $entry->created_by == Yii::$app->user->id ) echo 'owner-message'; ?>" style="margin-top: 15px;">
                    <a class="pull-left" href="<?php echo $entry->user->getUrl(); ?>"> <img
                                class="media-object img-rounded"
                                src="<?php echo $entry->user->getProfileImage()->getUrl(); ?>"
                                data-src="holder.js/50x50" alt="50x50"
                                style="width: 50px; height: 50px;">
                    </a>

					<?php if ( $entry->created_by == Yii::$app->user->id ): ?>
                        <div class="pull-right">
							<?php echo Html::a( '<i class="fa fa-pencil-square-o"></i>', [
								"/mail/mail/edit-entry",
								'messageEntryId' => $entry->id
							], array( 'data-target' => '#globalModal', 'class' => '' ) ); ?>
                        </div>
					<?php endif; ?>

                    <div class="media-body">
                        <h4 class="media-heading"
                            style="font-size: 14px;"><?php echo Html::encode( $entry->user->displayName ); ?>
                            <small><?php echo TimeAgo::widget( [ 'timestamp' => $entry->created_at ] ); ?></small>
                        </h4>

                        <span class="content">
                                <?= humhub\widgets\RichText::widget(['text' => $entry->content, 'record' => $entry, 'markdown' => true]) ?>
                            </span>
                        <div class="attach-content">
	                        <?= ShowFiles::widget(['object' => $entry]); ?>
                        </div>
                    </div>
                </div>


			<?php endforeach; ?>

        </ul>
        <!-- END: Results -->

        <script>
            var objDiv = document.getElementById("entry-messadge-content");
            objDiv.scrollTop = objDiv.scrollHeight;
        </script>


        <div class="row-fluid">
			<?php $form = CActiveForm::begin(); ?>

			<?php echo $form->errorSummary( $replyForm ); ?>
            <div class="form-group">

				<?php echo $form->textArea( $replyForm, 'message', array(
					'class'       => 'form-control',
					'id'          => 'newMessage',
					'rows'        => '4',

				) ); ?>

            </div>
            <hr>

            <script>
                $(document).ready(function() {
                    $("#newMessage").emojioneArea({
                    });
                });
            </script>

            <input id="post_submit_button" data-ui-loader type="submit"
                   value="post">

	        <?php
	        $uploadButton = humhub\modules\file\widgets\UploadButton::widget( [
		        'id'       => 'contentFormFiles',
		        'progress' => '#contentFormFiles_progress',
		        'preview'  => '#contentFormFiles_preview',
		        'dropZone' => '#contentFormBody',
		        'max'      => Yii::$app->getModule( 'content' )->maxAttachedFiles
	        ] );
	        ?>
	        <?= humhub\modules\file\widgets\FileHandlerButtonDropdown::widget( [ 'primaryButton'  => $uploadButton,
	                                                                             'handlers'       => FileHandlerCollection::getByType(FileHandlerCollection::TYPE_CREATE),
	                                                                             'cssButtonClass' => 'btn-default'
	        ] ); ?>



	        <?= \humhub\modules\file\widgets\UploadProgress::widget( [ 'id' => 'contentFormFiles_progress' ] ) ?>
	        <?= \humhub\modules\file\widgets\FilePreview::widget( [ 'id'      => 'contentFormFiles_preview',
	                                                                'edit'    => true,
	                                                                'options' => [ 'style' => 'margin-top:10px;' ]
	        ] ); ?>
			<?php CActiveForm::end(); ?>
        </div>
		<?php } ?>

    </div>
</div>
