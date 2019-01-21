<?php

$base_path = dirname(__DIR__);

$get_mysql_host = function ($path) {
    $result = '127.0.0.1';
    if (file_exists($path)) {
        $data = file_get_contents($path);
        if ($data !== false) {
            $result = trim($data);
        }
    }
    return $result;
};

$mysql_host = $get_mysql_host($base_path . '/runtime/properties/mysql_host');

$config = [
    'id' => 'mysite-yii',
    'vendorPath' => $base_path . '/vendor',
    'timeZone' => 'Europe/Moscow',
    'aliases' => [
        '@tmp_dir' => '@runtime/tmp',
        // Need for asset-packagist repo
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'basePath' => dirname(__DIR__),
    'runtimePath' => dirname(__DIR__) . '/runtime',
    'language' => 'ru-RU',
    'controllerNamespace' => 'app\\controllers',
    'defaultRoute' => 'site',
    'components' => [
        'assetManager' => [
            'appendTimestamp' => true,
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => []
        ],
        'request' => [
            'enableCookieValidation' => false,
            'cookieValidationKey' => '',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => false,
            'transport' => [
                'ExtraParams' => ''
            ]
        ],
        'cache' => [
            'class' => 'yii\\caching\\FileCache',
            'cachePath' => '@runtime/schema',
        ],
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'except' => ['yii\\db\\*',],
                    'levels' => ['error', 'warning', 'info'],
                    'logFile' => '@runtime/logs/app.log',
                    'logVars' => [],
                ]
            ],
        ],
        'session' => [
            'class' => 'yii\\web\\CacheSession',
            'timeout' => 86400,
            'cache' => [
                'class' => 'yii\\caching\\FileCache',
                'cachePath' => '@runtime/session',
            ],
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=' . $mysql_host . ':3306;dbname=base_database',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ]
    ]
];

if (defined('YII_ENV') && YII_ENV === 'dev') {
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        'allowedIPs' => ['*']
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['*']
    ];
}

return $config;
