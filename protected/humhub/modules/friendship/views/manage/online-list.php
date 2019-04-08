<?php
/**
 * Created by PhpStorm.
 * User: work
 * Date: 21.05.18
 * Time: 17:32
 */

?>
<?php foreach($online as $user) { ?>
<li class="friend">
    <a href="<?= $user->getUrl(); ?>">
		<div class="photo"><img src="<?= $user->getProfileImage()->getUrl(); ?>"><span class="active"></span></div>
		<div class="user-wrap">
			<div class="name"><?= $user->username; ?></div>
			<div class="user-desire"><?= $user->greatest_desire->title; ?></div>
		</div>
	</a>
</li>
<?php } ?>
