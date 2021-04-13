<?php

// comment out the following two lines when deployed to production
//на боевом сайте эти константы нужно закомментировать
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

$config = require __DIR__ . '/../config/web.php';

//подключаем нашу функцию debug
require_once __DIR__ . '/../libs/funcs.php';

(new yii\web\Application($config))->run();
