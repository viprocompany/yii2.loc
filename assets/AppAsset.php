<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
      'css/bootstrap.css',
      'css/style.css',
      'css/font-awesome.css',
      '//fonts.googleapis.com/css?family=Ubuntu:400,300,300italic,400italic,500,500italic,700,700italic',
      '//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic',
      'css/flexslider.css',

    ];
    public $js = [
      //делаем это для того чтобы  в файле config/web.php в компонентах  в assetManager можно было ипользовать jquery  версии из верстки , в частности при первоначальном подключении в AppAssets на странице оформления заказа не работала валидация полей формы, привязанная к дефолтной jquery более новой версии, то есть старая версия из верстки давала помеху работе, поэтому на данный момент подключили эту библиотеку в файле config/web.php, как дефолтную при этом подключении, которая будет подключаться на страницах сайта
//      'js/jquery-1.11.1.min.js',
      'js/bootstrap.min.js',
      'js/move-top.js',
      'js/easing.js',
      'js/jquery.flexslider.js',
      //удалить minicart после установки бутстрапа для вывода модальных окон
      'js/minicart.js',
      'js/okzoom.js',
      'js/jquery.wmuSlider.js',
      'js/waypoints.min.js',
      'js/counterup.min.js',
      'js/main.js',

    ];
    public $depends = [
      'yii\web\YiiAsset',


    ];
}
