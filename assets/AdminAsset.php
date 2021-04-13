<?php


namespace app\assets;


use yii\web\AssetBundle;

class AdminAsset extends AssetBundle
{
  public $basePath = '@webroot';
  public $baseUrl = '@web';
  public $css = [
    'adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css',
    'adminlte/bower_components/font-awesome/css/font-awesome.min.css',
    'adminlte/bower_components/Ionicons/css/ionicons.min.css',
    'adminlte/dist/css/AdminLTE.min.css',
    'adminlte/dist/css/skins/skin-blue.min.css',
    'https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic',


  ];
  public $js = [

    'adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js',
    'adminlte/dist/js/adminlte.min.js',
    //подключен на  для работы меню заказов в сайдбаре админки,для переключения класса активности между пунктами меню
    'js/admin_order.js',



  ];
  public $depends = [
    'yii\web\YiiAsset',


  ];
}