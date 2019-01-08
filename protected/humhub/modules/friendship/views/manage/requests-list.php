<?php
/**
 * Created by PhpStorm.
 * User: work
 * Date: 21.05.18
 * Time: 11:37
 */

use yii\helpers\Html;

foreach($users as $user) { ?>

	<li class="friend">

		<div class="photo"><img src="<?= $user->getProfileImage()->getUrl(); ?>"></div>
		<div class="user-wrap">
            <a href="<?= $user->getUrl(); ?>">
			<div class="name"><?= $user->username; ?></div>
			<div class="user-desire"><?= $user->greatest_desire->title; ?></div>
            </a>
			<div class="btn-block">
				<div class="base-sm-btn"><?= Html::a('Accept', ['/friendship/request/add', 'userId' => $user->id], ['class' => '', 'data-method' => 'POST']); ?></div>
				<div class="base-sm-btn"><?= Html::a('Reject', ['/friendship/request/delete', 'userId' => $user->id], ['class' => '', 'data-method' => 'POST']); ?></div>
			</div>
		</div>

	</li>

<?php } ?>