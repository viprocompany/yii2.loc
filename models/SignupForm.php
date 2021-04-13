<?php


namespace app\models;


use yii\base\Model;

class SignupForm extends Model
{
  public $username;
  public $password;
  public $auth_key;
  public $is_admin;

  public function rules() {
    return [
      [['username', 'password'], 'required', 'message' => 'Заполните поле'],
      ['username', 'email'],
      //делаем защиту от повторной регистрации с одной почтой, так как в БД это поле уникально и , если не сделать  защиту здесь, то на сайте будет выскакивать ошибка серевера
      ['username', 'unique', 'targetClass' => User::class,  'message' => 'Пользователь с таким Email зарегистрирован!'],
    ];
  }

  public function attributeLabels() {
    return [
      'username' => 'Email',
      'password' => 'Пароль',
    ];
  }
}