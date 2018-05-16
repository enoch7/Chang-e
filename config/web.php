<?php

$params = require(__DIR__ . '/params.php');
$db = require(__DIR__ . '/db.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language'=>'zh-CN',
    'modules' => [
        'admin' => [
            'class' => 'app\modules\admin\Admin',
        ], 
    ],
    'components' => [
        'urlManager' => [       
             // 'urlFormat'=>'path',
            'enablePrettyUrl' => true,
            // 'showScriptName'=>FALSE,
            // 'suffix'=>'.html',
            'rules'=>array(
                '<controller:\w+>/<id:\d+>'=>'<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
                '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
            )
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'Ui_fv5TAIjOxvb1QOWERAAVRZYtMYqD2',
        ],
        'redis' => [
            'class' => 'yii\redis\Connection',
            'hostname'  => '127.0.0.1',
            'port'  => 6379,
            'database' => 0,
            'password' => '1',
        ],

        'redis-haha' => [
            'class' => 'app\connections\RedisConnection',
            'hostname' => '127.0.0.1',
            'port' => 6379,
            'database' => 0,
            'password' => '1',
        ],

        'cache' => [
            // 'class' => 'yii\caching\FileCache',
            'class' => 'yii\redis\Cache',
            'redis' => 'redis',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
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
        'db' => $db,
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
    ],
    'aliases' => [
        '@work' => dirname(__DIR__) . '/comp/work',
        '@common' => dirname(__DIR__) . '/common/src',
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
