<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace yii\authclient\clients;

/**
 * GoogleHybrid is an enhanced version of the [[GoogleOAuth]], which uses Google+ hybrid sign-in flow,
 * which relies on embedded JavaScript code to generate a sign-in button.
 *
 * Example application configuration:
 *
 * ```php
 * 'components' => [
 *     'authClientCollection' => [
 *         'class' => 'yii\authclient\Collection',
 *         'clients' => [
 *             'google' => [
 *                 'class' => 'yii\authclient\clients\GoogleHybrid',
 *                 'clientId' => 'google_client_id',
 *                 'clientSecret' => 'google_client_secret',
 *             ],
 *         ],
 *     ]
 *     ...
 * ]
 * ```
 *
 * JavaScript button itself generated by [[yii\authclient\widgets\GooglePlusButton]] widget. If you are using
 * [[yii\authclient\widgets\AuthChoice]] it will appear automatically. Otherwise you need to add it into your page manually.
 * You may customize its appearance using 'widget' key at [[viewOptions]]:
 *
 * ```php
 * 'google' => [
 *     ...
 *     'viewOptions' => [
 *         'widget' => [
 *             'class' => 'yii\authclient\widgets\GooglePlusButton',
 *             'buttonHtmlOptions' => [
 *                 'data-approvalprompt' => 'force'
 *             ],
 *         ],
 *     ],
 * ],
 * ```
 *
 * @see GoogleOAuth
 * @see yii\authclient\widgets\GooglePlusButton
 * @see https://developers.google.com/+/web/signin
 *
 * @author Paul Klimov <klimov.paul@gmail.com>
 * @since 2.0
 */
class GoogleHybrid extends GoogleOAuth
{
    /**
     * @inheritdoc
     */
    protected function defaultReturnUrl()
    {
        return 'postmessage';
    }

    /**
     * @inheritdoc
     */
    protected function defaultViewOptions()
    {
        return [
            'widget' => [
                'class' => 'yii\authclient\widgets\GooglePlusButton'
            ],
        ];
    }
} 