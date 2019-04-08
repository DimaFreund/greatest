<?php
/**
 * Created by PhpStorm.
 * User: work
 * Date: 04.07.18
 * Time: 15:26
 */

use yii\bootstrap\ActiveForm;
use yii\helpers\Url;





?>

<div class="page-content">
	<div class="content-wrap">
		<div class="profile-settings">
			<div class="base-kaushan-title"><?= Yii::t('UserModule.views_account_edit', 'Settings') ?></div>
			<?php $form = ActiveForm::begin(['enableClientValidation' => false]); ?>

				<div class="profile-info general-info">
					<div class="title"><?= Yii::t('UserModule.views_account_edit', 'General Info') ?></div>
					<?= $form->field($user->profile, 'firstname',[
					        'options' => [
					                'class' => 'form-item sm-item',
                            ]]); ?>

					<?= $form->field($user->profile, 'lastname',[
					        'options' => [
					                'class' => 'form-item sm-item',
                            ]]); ?>

					<div class="form-item">
                        <label for="desire-input"><?= Yii::t('UserModule.views_account_edit', 'My Greatest Desire is…') ?></label>
                        <?= $form->field($user->greatestDesire, 'title', [
                                'options' => [
                                        'tag' => false,
                                ]
                        ])->textarea(['id' => 'desire-input'])->label(false); ?>


                        <p class="desire-input-desc"><?= Yii::t('UserModule.views_account_edit', 'You can change Greatest Desire') ?><a href="<?= Url::to(['/desire/desire/update', 'id' => $user->greatest_desire]); ?>"> <?= Yii::t('UserModule.views_account_edit', 'here') ?></a></p>
                        <p class="desire-input-desc"><?= Yii::t('UserModule.views_account_edit', 'You can add more any desires') ?><a href="<?= Url::to(['/desire/desire/create']); ?>"> <?= Yii::t('UserModule.views_account_edit', 'here') ?></a></p>
					</div>
					<div class="form-item personal-info">

						<div class="photo">
							<div class="personal-info-label"><?= Yii::t('UserModule.views_account_edit', 'Add profile photo') ?></div>

							<div class="wrap">
								<div class="img-block">
									<?= \humhub\modules\user\widgets\UserPhotoControl::widget(['user' => $user]); ?>
                                </div>
                            </div>
						</div>

						<div class="birthday">
							<div class="personal-info-label"><?= Yii::t('UserModule.views_account_edit', 'Birthday*') ?></div>
							<div class="wrap"><label><svg class="icon icon-calendar"><use xlink:href="./svg/sprite/sprite.svg#calendar"></use></svg>
									<?= \humhub\widgets\DatePicker::widget([
									        'model' => $user->profile,
                                            'attribute' => 'birthday',
                                            'options' => ['id' => 'datepicker'],
                                            'clientOptions' => [
                                                    'changeYear' => true,
                                                    'yearRange' => (date('Y') - 100) . ":" . (date('Y')),
                                                    'changeMonth' => true,
                                            ]
                                    ]); ?>
                                </label>
                            </div>
						</div>

						<div class="gender">
							<div class="personal-info-label"><?= Yii::t('UserModule.views_account_edit', 'Gender*') ?></div>

                            <?= $form->field($user->profile, 'gender',[
                                    'options' => [
                                            'tag' => false,
                                    ]
                            ])->radioList($user->profile->getOptionsField('gender'), ['class' => 'wrap radio-btn-wrap'])->label(false); ?>
						</div>
					</div>
					<div class="form-item pass-change">
						<div class="item-label"><?= Yii::t('UserModule.views_account_edit', 'Here you can change your password') ?></div>
						<p><?= Yii::t('UserModule.views_account_edit', 'To save old password, just leave this field empty. To change, enter new password and confirm it.') ?></p>
					</div>

					<?php if ($changePasswordModel->isAttributeSafe('currentPassword')): ?>
						<?php echo $form->field($changePasswordModel, 'currentPassword',['options' => ['class' => 'form-item sm-item']])->passwordInput(['maxlength' => 45]); ?>
                        <hr>
					<?php endif; ?>

					<?php echo $form->field($changePasswordModel, 'newPassword', ['options' => ['class' => 'form-item sm-item']])->passwordInput(['maxlength' => 45]); ?>

					<?php echo $form->field($changePasswordModel, 'newPasswordConfirm', ['options' => ['class' => 'form-item sm-item']])->passwordInput(['maxlength' => 45]); ?>

					<div class="form-item site-notifications">
                        <input name="Notification[interval]" <?= $notificationOn ?'checked':''; ?> id="site-notification" type="checkbox">
                        <label for="site-notification"><?= Yii::t('UserModule.views_account_edit', 'Receive Site Notifications') ?></label>
                    </div>
				</div>



				<div class="profile-info additional-info">
					<div class="title"><?= Yii::t('UserModule.views_account_edit', 'Additional Info') ?></div>

                    <?= $form
                        ->field($user->profile, 'description', [
                            'options' => [
                                    'class' => 'form-item',
                            ]
                        ])
                        ->textarea(['placeholder' => $user->profile
                        ->getAttributeLabel( 'description' )])->label(false);
                    ?>

					<div class="form-item sm-item">
						<div class="label"><?= Yii::t('UserModule.views_account_edit', 'Country*') ?></div>
						<?= $form->field($user->profile, 'country',[
							'options' => [
								'tag' => false,
							]])->dropDownList($user->profile->getOptionsField('country'), ['class' => false])->label(false) ?>
                    </div>

                    <?= $form->field($user->profile, 'city',[
						'options' => [
							'class' => 'form-item sm-item',
						]]); ?>

					<?= $form->field($user->profile, 'occupation',[
						'options' => [
							'class' => 'form-item sm-item',
						]]); ?>


					<div class="form-item sm-item">
						<div class="label"><?= Yii::t('UserModule.views_account_edit', 'Relationship Status') ?></div>
						<?= $form->field($user->profile, 'relationship',[
							'options' => [
								'tag' => false,
							]])->dropDownList($user->profile->getOptionsField('relationship'), ['class' => false])->label(false) ?>
                    </div>

                    <?= $form->field($user->profile, 'education',[
						'options' => [
							'class' => 'form-item sm-item',
						]]); ?>

					<?= $form->field($user->profile, 'ethnicity',[
						'options' => [
							'class' => 'form-item sm-item',
						]]); ?>

					<?= $form
						->field($user->profile, 'hobbies', [
							'options' => [
								'class' => 'form-item',
							]
						])
						->textarea(['placeholder' => $user->profile
							->getAttributeLabel( 'hobbies' )])->label(false);
					?>

					<?= $form
						->field($user->profile, 'interests', [
							'options' => [
								'class' => 'form-item',
							]
						])
						->textarea(['placeholder' => $user->profile
							->getAttributeLabel( 'interests' )])->label(false);
					?>

					<?= $form
						->field($user->profile, 'favorite_music', [
							'options' => [
								'class' => 'form-item',
							]
						])
						->textarea(['placeholder' => $user->profile
							->getAttributeLabel( 'favorite_music' )])->label(false);
					?>

					<?= $form
						->field($user->profile, 'favorite_films', [
							'options' => [
								'class' => 'form-item',
							]
						])
						->textarea(['placeholder' => $user->profile
							->getAttributeLabel( 'favorite_films' )])->label(false);
					?>

					<?= $form
						->field($user->profile, 'favorite_books', [
							'options' => [
								'class' => 'form-item',
							]
						])
						->textarea(['placeholder' => $user->profile
							->getAttributeLabel( 'favorite_books' )])->label(false);
					?>
				</div>
				<div class="profile-info profile-privacy">
					<div class="title"><?= Yii::t('UserModule.views_account_edit', 'Profile privacy') ?></div>
					<div class="form-item sm-item">
						<div class="label"><?= Yii::t('UserModule.views_account_edit', 'Who can see you') ?></div><select><option><?= Yii::t('base','Public'); ?></option><option><?= Yii::t('base','Private'); ?></option><option><?= Yii::t('base','Public'); ?></option></select></div>
					<div class="form-item sm-item">
						<div class="label"><?= Yii::t('UserModule.views_account_edit', 'Who can contact you') ?></div><select><option><?= Yii::t('base','Public'); ?></option><option><?= Yii::t('base','Private'); ?></option><option><?= Yii::t('base','Public'); ?></option></select></div>
				</div>
				<div class="profile-info social-btn">
					<div class="title"><?= Yii::t('UserModule.views_account_edit', 'Connect to your account') ?></div>
					<?= $socialButton; ?>
				</div>
				<p class="bottom-sub-title"><?= Yii::t('UserModule.views_account_edit', 'Invite your Facebook friends') ?></p>

				<div class="base-btn reverse"><input type="submit" value="<?= Yii::t('base','Save'); ?>"></div>



			<?php ActiveForm::end(); ?>
		</div>
	</div>
</div>
<form class="fileupload" id="profilefileupload" action="" method="POST" enctype="multipart/form-data"
      style="position: absolute; top: 0; left: 0; opacity: 0; height: 140px; width: 140px;">
    <input type="file" aria-hidden="true" name="images[]">
</form>
