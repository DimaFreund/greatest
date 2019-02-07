<?php

$newsRecord = $viewable->getNewsReccord();
?>

<?php $this->beginContent('@notification/views/layouts/mail.php', $_params_); ?>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" align="left">
		<tr>
			<td>
				<?=
				humhub\widgets\mails\MailContentEntry::widget([
					'content' => $newsRecord,
					'date' => $date,
					'space' => $space
				])
				?>
			</td>
		</tr>
		<tr>
			<td height="10"></td>
		</tr>
		<tr>
			<td>
				<?=
				\humhub\widgets\mails\MailButtonList::widget([
					'buttons' => [
						humhub\widgets\mails\MailButton::widget(['url' => $url, 'text' => Yii::t('NewsModule.notifications', 'View Online')])
					]
				])
				?>
			</td>
		</tr>
	</table>
<?php
$this->endContent();
