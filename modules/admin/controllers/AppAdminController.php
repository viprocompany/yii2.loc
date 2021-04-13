<?php


namespace app\modules\admin\controllers;


use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\web\Controller;

class AppAdminController extends Controller
{
//  public function behaviors() убирал в Module.php, сейчас переделал  с ролями админа и вернул, войти в админку
// может только зарегистрированннй пользователь, но только через сайт. Форма для входа в админконтроллер не
// показвается, идет редирект на site/login



  public function behaviors()
  {
    //код с поведением копируем из SiteController и настраиваем правила для гостей 'roles' => ['?'] и для  авторизованных пользвателей 'roles' => ['@']

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

    return [
      'access' => [
        'class' => AccessControl::class,
        'rules' => [
          [

            'actions' => ['login','signup'],
            'allow' => true,
            'roles' => ['?'],

//            'allow' => false,
//            'roles' => ['?'],
//            'denyCallback' => function($rule, $action) {
//              return $this->redirect(Url::to(['/site/login']));
//            }
          ],
          [
            //защищаем контроллер от входа обычных пользователей
            'actions' => [],
            'allow' => true,
            'roles' => ['@'],
            'matchCallback' => function ($rule, $action) {
              /** @var User $user */
              $user = Yii::$app->user->getIdentity();
              return $user->isAdmin() || $user->isManager();
            }
          ],
        ],
      ],
    ];
  }
////выдает ошибку циклического перенапрвления на странице
//  public function beforeAction($action) {
//    $session = Yii::$app->session;
//    $session->open();
//    if (!$session->has('auth_site_admin')) {
//      $this->redirect('/admin/auth/adminin');
//      return false;
//    }
//    return parent::beforeAction($action);
//  }

}