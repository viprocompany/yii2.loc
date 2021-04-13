<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property-read User|null $user This property is read-only.
 *
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;

    private $_user = false;

  public function attributeLabels()
  {
    return [
      'rememberMe' => 'Запомнить меня',
    ];
  }

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
            ['username', 'email'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Некорректные данные логина или пароля.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
      // если прошла валидация вызывается метод login компонента User, происходит авторизация пользователя путем  передачи объекта пользователя $this->getUser()
        if ($this->validate()) {
          //проверяем выбрана ли галка "запомнить меня"
          if ($this->rememberMe){
            //создаем обект, котрый получает пользовватавеля методом getUser класса User.php
            $u = $this->getUser();
            //генерируем для этого пользователя куку методом generateAuthKey класса User.php
             $u->generateAuthKey();
            //сохраняем в базу в таблицу 'user'
            $u->save();
          }
            return Yii::$app->user->login($this->getUser(),
              // время хранения данных из чекбокса rememberMe ? 3600*24*9
              $this->rememberMe ? 3600*24*90 : 0);
        }
        return false;
    }



    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
          //поиск пользователя по полю username в таблице user, которому должно соответсвовать значение имэйла из  поля формы авторизации
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }



//для администратора
//  public static function loginAdmin() {
//    $session = Yii::$app->session;
//    $session->open();
//    $session->set('auth_site_admin', true);
//  }
//
//
//  public static function logoutAdmin() {
//    $session = Yii::$app->session;
//    $session->open();
//    if ($session->has('auth_site_admin')) {
//      $session->remove('auth_site_admin');
//    }
//  }


}
