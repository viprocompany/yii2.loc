<?php


namespace app\modules\admin\controllers;


use app\models\LoginForm;
use Yii;

class AuthController extends AppAdminController
{
//$layout это свойство , котрое мы можем переопределить где угодно, там оно и будет действовать, здесь на весь   контроллер. Это нужно чтобы страница авторизации выходила не в дефолтном для модуля лэйауте admin, а в auth, пердназначенном для авторизации
public $layout = 'auth';

  public function actionLogin()
  {
    // из формы на странице авторизации /admin приходят данные из инпутов
    if (!Yii::$app->user->isGuest) {
      //если пользователь не авторизован, переход  в админку
      return $this->redirect('/admin');
//      return $this->goHome();
    }
// из формы на странице авторизации /admin приходят данные из инпутов, пытаемся их загрузить и вызываем метод
//создаем модель login класса-модели LoginForm
    $model = new LoginForm();
    //пытаемся загрузить  данные пришедшие постом и пытаемся авторизоваться методом $model->login()
    if ($model->load(Yii::$app->request->post()) && $model->login()) {
      //переход  в админку
      return $this->redirect('/admin');
//      return $this->goBack();
    }
//очищаем атрибут password модели $model,чтобы не было заполнено соответствующее поле в представлении
    $model->password = '';
    //рендерим представление login и передаем в него модель 'model' => $model,
    return $this->render('login', [
      'model' => $model,
    ]);
  }




  public function actionLogout()
  {
    //выход из авторизации с использованием компонента user и его метода logout
    Yii::$app->user->logout();
    //переход  в админку, если не авторизован будет переход на форму авторизации
    return $this->redirect('/admin');
//    return $this->goHome();
  }




  //для администратора
//  public function actionAdminin()
//  {
//    $model = new LoginForm();
//    /*
//     * Если пришли post-данные, загружаем их в модель...
//     */
//    if ($model->load(Yii::$app->request->post())) {
//      // ...и проверяем эти данные
//      if ($model->validate()) {
//        // данные корректные, пробуем авторизовать
//        if (Yii::$app->params['adminEmail'] == $model->email
//          && Yii::$app->params['adminPassword'] == $model->password) {
//          LoginForm::loginAdmin();
//          return $this->redirect('/admin');
//        } else {
//          $model->password = '';
//        }
//      }
//    }
//    return $this->render('login', ['model' => $model]);
//  }

  //для администратора

//  public function actionLogoutAdmin() {
//    LoginForm::logoutAdmin();
//    return $this->redirect('/admin/auth/adminin');
//  }

}