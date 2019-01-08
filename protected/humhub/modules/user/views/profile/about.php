<?php

use yii\helpers\Html;
use humhub\widgets\RichText;
use humhub\modules\user\models\fieldtype\MarkdownEditor;
use humhub\widgets\MarkdownView;
use yii\helpers\Url;

?>
<?php $profile = $user->profile; ?>

    <div class="content-wrap">
        <div class="personal-profile-info">
            <div class="title">Information</div>
            <div class="info-block">
                <?php if(!empty($profile->firstname)) { ?>
                <div class="item">
                    <div class="label">First name</div>
                    <div class="text"><?= $profile->firstname; ?></div>
                </div>
	            <?php } ?>
                <?php if(!empty($profile->lastname)) { ?>
                <div class="item">
                    <div class="label">Last name</div>
                    <div class="text"><?= $profile->lastname; ?></div>
                </div>
	            <?php } ?>
                <?php if(!empty($profile->gender)) { ?>
                <div class="item">
                    <div class="label">Gender</div>
                    <div class="text"><?= $profile->gender; ?></div>
                </div>
	            <?php } ?>
                <?php if(!empty($profile->city)) { ?>
                <div class="item location">
                    <div class="label">From</div>
                    <div class="text">
                        <svg class="icon icon-location">
                            <use xlink:href="./svg/sprite/sprite.svg#location"></use>
                        </svg>
                        <?= $profile->city; ?>
                    </div>
                </div>
	            <?php } ?>

                <?php if(!empty($profile->birthday)) { ?>
                <div class="item">
                    <div class="label">Birth</div>
                    <div class="text"><?= $profile->birthday; ?></div>
                </div>
	            <?php } ?>

                <?php if(!empty($profile->age)) { ?>
                <div class="item">
                    <div class="label">Age</div>
                    <div class="text"><?= $profile->age; ?></div>
                </div>
	            <?php } ?>

                <?php if(!empty($profile->country)) { ?>
                <div class="item">
                    <div class="label">Country</div>
                    <div class="text"><?= $user->profile->getOptionsField('country')[$profile->country]; ?></div>
                </div>
	            <?php } ?>

                <?php if(!empty($profile->education)) { ?>
                <div class="item">
                    <div class="label">Education</div>
                    <div class="text"><?= $profile->education; ?></div>
                </div>
	            <?php } ?>

                <?php if(!empty($profile->ethnicity)) { ?>
                <div class="item">
                    <div class="label">Ethnicity</div>
                    <div class="text"><?= $profile->ethnicity; ?></div>
                </div>
	            <?php } ?>

                <?php if(!empty($profile->relationship)) { ?>
                <div class="item">
                    <div class="label">Relationship Status</div>
                    <div class="text"><?= $profile->relationship; ?></div>
                </div>
	            <?php } ?>

            </div>
	        <?php if(!empty($profile->joined)) { ?>
            <div class="creation-date">
                <div class="label">Joined</div>
                <div class="text"><?= $user->profile->joined; ?></div>
            </div>
            <?php } ?>

            <?php if($profile->description) { ?>
            <div class="description">
                <div class="desc-title">Description</div>
                <div class="text">
                    <?= $profile->description; ?>
                </div>
            </div>
            <?php } ?>

            <?php if($profile->hobbies) { ?>
            <div class="description">
                <div class="desc-title">Hobbies</div>
                <div class="text">
                    <?= $profile->hobbies; ?>
                </div>
            </div>
            <?php } ?>

            <?php if($profile->interests) { ?>
            <div class="description">
                <div class="desc-title">Interests</div>
                <div class="text">
                    <?= $profile->interests; ?>
                </div>
            </div>
            <?php } ?>

            <?php if($profile->favorite_music) { ?>
            <div class="description">
                <div class="desc-title">Favorite Music</div>
                <div class="text">
                    <?= $profile->favorite_music; ?>
                </div>
            </div>
            <?php } ?>

            <?php if($profile->favorite_films) { ?>
            <div class="description">
                <div class="desc-title">Favorite Films</div>
                <div class="text">
                    <?= $profile->favorite_films; ?>
                </div>
            </div>
            <?php } ?>

            <?php if($profile->favorite_books) { ?>
            <div class="description">
                <div class="desc-title">Favorite Books</div>
                <div class="text">
                    <?= $profile->favorite_books; ?>
                </div>
            </div>
            <?php } ?>

            <div class="sub-context-menu">
                <div class="context-menu-btn"><span></span><span></span><span></span></div>
                <ul class="context-menu">
                    <li><a href="<?= Url::to(['account/edit']); ?>">Edit</a></li>
                </ul>
            </div>
        </div>
    </div>
