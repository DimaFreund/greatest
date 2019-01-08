<?php

use yii\helpers\Html;
?>

        <?php if (!$poll->hasUserVoted() && !$poll->closed) { ?>
                <?php if ($poll->allow_multiple) : ?>
                    <div class="checkbox">
                        <?php echo Html::checkBox('answers[' . $answer->id . ']', false, ['label' => $answer->answer]); ?>
                    </div>

                <?php else: ?>
                     <?php echo Html::radio('answers', false, array('value' => $answer->id, 'id' => 'answer_' . $answer->id, 'label' => $answer->answer, 'data-action-click' =>'vote', 'data-action-submit' => true, 'data-ui-loader' => true )); ?>
                <?php endif; ?>
        <?php } else { ?>

        <?php
        $percent = round($answer->getPercent());
        ?>

        <div class="item">
            <div class="label"><?php echo $answer->answer; ?></div>
            <div class="diagram"><span style="width: <?php echo $percent; ?>%"></span></div>
            <div class="val"><?php
	            $userlist = ""; // variable for users output
	            $maxUser = 10; // limit for rendered users inside the tooltip

	            if (!$poll->anonymous) {
		            for ($i = 0; $i < count($answer->votes); $i++) {

			            // if only one user likes
			            // check if exists more user as limited
			            if ($i == $maxUser) {
				            // output with the number of not rendered users
				            $userlist .= Yii::t('PollsModule.widgets_views_entry', 'and {count} more vote for this.', array('{count}' => (intval(count($answer->votes) - $maxUser))));

				            // stop the loop
				            break;
			            } else {
				            $userlist .= Html::encode($answer->votes[$i]->user->displayName) . "\n";
			            }
		            }
	            }

	            ?>
                <p style="margin-top: 14px; display:inline-block;" class="tt" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo $userlist; ?>">
		            <?php if (!$poll->anonymous && count($answer->votes) > 0) { ?>
                        <a href="<?php echo $contentContainer->createUrl('/polls/poll/user-list-results', array('pollId' => $poll->id, 'answerId' => $answer->id)); ?>" data-target="#globalModal">
				            <?php echo count($answer->votes) ?>
                        </a>
		            <?php } else if(count($answer->votes) > 0) { ?>
			            <?php echo count($answer->votes) ?>
		            <?php } else { ?>
                        0
		            <?php } ?>

                </p></div>
        </div>
        <?php } ?>

    <div class="clearFloats"></div>