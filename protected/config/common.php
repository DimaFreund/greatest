<?php

return [
	'components' => [
		'authClientCollection' => [
			'clients' => [
				'facebook' => [
					'class' => 'humhub\modules\user\authclient\Facebook',
					'clientId' => '1516365641795595',
					'clientSecret' => 'cb0767c2a412a143a52d33b0e3cde83f',
				],
				'google' => [
					'class' => 'humhub\modules\user\authclient\Google',
					'clientId' => '909741672549-gqdu4t8q53slhb73oirshmujej32g80i.apps.googleusercontent.com',
					'clientSecret' => 'l1Wdu5sYqSMr96ynFjEALc_t',
					'returnUrl' => 'https://gd.page.ua/index.php/user/auth/external?authclient=google',
				],
			],
		],
	],
];
