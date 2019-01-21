<?php

define('YII_DEBUG', true);
define('YII_ENV', 'dev');

defined('NON_YII_PATH') or define('NON_YII_PATH', false);

require(__DIR__ . '/../vendor/autoload.php');
require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');

$config = require(__DIR__ . '/../config/main.php');

$app = new \yii\web\Application($config);
$app->run();

