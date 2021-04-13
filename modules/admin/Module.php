<?php

namespace app\modules\admin;

use Yii;
use yii\filters\AccessControl;
use yii\helpers\Url;

/**
 * admin module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\admin\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }

  //код с поведением копируем из SiteController и настраиваем правила для гостей 'roles' => ['?'] и для  авторизованных пользвателей 'roles' => ['@']
//  public function behaviors()
//  {
//    return [
//      'access' => [
//        'class' => AccessControl::class,
//        'rules' => [
//          [
//            //если пользователь не авторизован ему можно на login или на signup, автоматом перекинет на страницу  авторизации  /site/login
//            'actions' => ['login','signup'],
//            'allow' => true,
//            'roles' => ['?'],
//          ],
//          [
//            //авторизованный пользователь может переходить везде
//            'allow' => true,
//            'roles' => ['@'],
//          ],
//        ],
//      ],
//
//    ];
//  }


}
