<?php

use yii\filters\AccessControl;

$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php',
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'uz',
    'modules' => [
        
        'gridview' => [
        'class' => 'kartik\grid\Module',],
    	'gii' => [
	    'class' => 'yii\gii\Module',
	    'allowedIPs' => ['127.0.0.1', '::1', '192.168.1.*', 'XXX.XXX.XXX.XXX']
	]
    ],
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
                'ko\'rsatma/taqiqlash/' => 'caution/embargo',
                'ko\'rsatma/bartaraf_etish/' => 'caution/prevention',
                'ko\'rsatma/taqiqlash/<id:\d+>' => 'caution/embargo-view',
                'ko\'rsatma/bartaraf_etish/<id:\d+>' => 'caution/prevention-view',
                'ko\'rsatma/taqiqlash/tahrirlash/<id:\d+>' => 'caution/embargo-update',
                
            ],
        ],
    ],
    'params' => $params,
];
