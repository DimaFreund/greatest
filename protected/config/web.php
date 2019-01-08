<?php

return [
    'components' => [
        'urlManager' => [
            'enablePrettyUrl' => true,
            'rules' => [
                // Your rules here
            ],
        ],
    ],
    'modules' => [
	    'gii' => [
		    'class' => 'humhub\modules\devtools\gii\Module',
		    'allowedIPs' => ['195.245.221.103', '::1'],
	    ],
    ]
];

