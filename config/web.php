<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname( __DIR__ ),
    'bootstrap' => ['log'],
    'defaultRoute' => 'home/index',
    'language' => 'ru',
    'name' => 'Grocery shop',
    'layout' => 'grocery',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    //код вставляем, котрый получили при генерации модуля админа при помощи генерации модуля в  Gii
    'modules' => [
        'admin' => [
            'class' => 'app\modules\admin\Module',
            //задаем дефолтный путь для вывода шаблона, фактически \modules\admin\views\main\index.php
            'defaultRoute' => 'main/index',
            //задаем шаблон для вывода модуля из modules/admin/views/layouts/admin.php, для страницы аутентификации можно  задать модуль внутри контроллера Auth, чтобы не прибегать к лэйауту admin
            'layout' => 'admin',

        ],
    ],
    'components' => [
        //форматирование  выводимых данных
        'formatter' => [
            'datetimeFormat' => 'php: d F Y H:i:s',
            //          'decimalSeparator' => ',',
            //          'thousandSeparator' => ' ',
            //          'currencyCode' => 'EUR',
        ],
        // assetManager добавляем для перенастройки подключения библиотеки jQuery, так как в верстке была  задана более старая версия, чем дефолтная для Yii2. Код берем в документации 'Настройка Комплектов Ресурсов'
        'assetManager' => [
            'bundles' => [
                'yii\web\JqueryAsset' => [
                    'sourcePath' => null,   // не опубликовывать комплект
                    'js' => [
                        // js/jquery-1.11.1.min.js забираем из массива $js файла AppAssets.php, где изначально подключали все скрипты и стили из верстки, а там этот код комментируем
                        //делаем это для того чтобы  можно было ипользовать jquery  версии из верстки, в частности при первоначальном подключении в AppAssets на странице оформления заказа не работала валидация полей формы, привязанная к дефолтной jquery более новой версии, то есть старая версия из верстки давала помеху работе
                        // по факту в дефолт для JqueryAsset по умолчанию для сайта  подключаем js/jquery-1.11.1.min.js
                        'js/jquery-1.11.1.min.js',
                    ]
                ],
            ],
        ],
        'request' => [
            // !!! insert a secret key in the following ( if it is empty ) - this is required by cookie validation
            'cookieValidationKey' => 'KLtsiFu4ZCNwKxiifTmJ2YLAtcZzAVU0',
            'baseUrl' => '',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        //аутентификация пользователей
        'user' => [
            'identityClass' => 'app\models\User',
            //          автоматическое залогинивание, если был запомнен при авторизации
            'enableAutoLogin' => true,
            //страница или маршрут для аутентификации пользователя /модуль/контроллер/экшн
            'loginUrl' => '/admin/auth/login',
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            //  PHP класс swiftmailer используется как встроенный для Yii2
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            //заглушка для писем включена как true
            'useFileTransport' => false,
            //настройки  транспорта
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                //$mailSMTP = new SendMailSmtpClass( 'vitalijbitrix@gmail.com', 'Vitalij6866486', 'ssl://smtp.gmail.com', 465, 'UTF-8' );
                'host' => 'smtp.gmail.com',
                'username' => 'мыло',
                'password' => 'пароль',
                'port' => '465',
                'encryption' => 'ssl',
            ],
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

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false,
            'rules' => [
                //если в запросе встретится формат ссылки   'category/с именованным параметром <id и разрешаем цифровое отображение хотя бы один знак, то в результате этому адресу будет соответствовать такой маршрут 'category/view' контроллер? category, экшн? view, а id пойдет параметром
              //            ],
              //более узкое правило прописывае выше , чем более общее, так как если сработает общее правило, то более конкретное ниже него уже не запускается(правило читается с левой части строки и срабатывает по совпадению правила и адреса, то есть изначально проверяется category/<id:\d+> во всех правилах, если есть продолжение типа page/<page:\d+> то оно срабатывает, затем уже срабатывает то правило где нет продожения типа page/<page:\d+> или что-то другое
              'category/<id:\d+>/page/<page:\d+>' => 'category/view',
              'category/<id:\d+>' => 'category/view',
              'product/<id:\d+>' => 'product/view',
              'search' => 'category/search',
            ],
        ],

    ],
  //взято с Гитхаба https://github.com/MihailDev/yii2-elfinder для загрузки картинок визуального редактора CKeditor,  также был установлен композером с гитхаба https://github.com/MihailDev/yii2-ckeditor
  'controllerMap' => [
    'elfinder' => [
      'class' => 'mihaildev\elfinder\PathController',
      //ограничение доступа для авторизованных пользователей
      'access' => ['@'],
      'root' => [
        //куда будут загружаться файлы, папку files файловый менеджер создаст автоматически
        'path' => 'upload/files',
        //название папки files в файловой системе, как её увидит человек, котрый будет загружать картинки
        'name' => 'Files'
      ],
      //водяные знаки нам сейчас не нужны
//      'watermark' => [
//        'source'         => __DIR__.'/logo.png', // Path to Water mark image
//        'marginRight'    => 5,          // Margin right pixel
//        'marginBottom'   => 5,          // Margin bottom pixel
//        'quality'        => 95,         // JPEG image save quality
//        'transparency'   => 70,         // Water mark image transparency ( other than PNG )
//        'targetType'     => IMG_GIF|IMG_JPG|IMG_PNG|IMG_WBMP, // Target image formats ( bit-field )
//        'targetMinPixel' => 200         // Target image minimum pixel size
//      ]
    ]
  ],
    'params' => $params,
];
//YII_ENV_DEV константа для разработки, если её вывод закоментировать во фронтконтроллкере  и YII_DEBUG тоже  -индексном  файле  сайта(web/index.php),  то из правого нижнего угла страниц сайта исчезнет иконка Yii2 для отладки
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