<?php

use yii\filters\AccessControl;

$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'uz',
    'controllerNamespace' => 'frontend\controllers',

    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
            'baseUrl' => '',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
            'loginUrl' => '/site/login',
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],

        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'ko\'rsatma/taqiqlash/' => 'embargo/index',
                'ko\'rsatma/bartaraf_etish/' => 'prevention/index',
                'ko\'rsatma/taqiqlash/<id:\d+>' => 'embargo/view',
                'ko\'rsatma/bartaraf_etish/<id:\d+>' => 'prevention/view',
                'ko\'rsatma/taqiqlash/tahrirlash/<id:\d+>' => 'embargo/update',
                'ko\'rsatma/bartaraf_etish/tahrirlash/<id:\d+>' => 'prevention/update',
            ],
        ],
    ],
    'params' => $params,
];
