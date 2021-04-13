<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class User extends ActiveRecord implements \yii\web\IdentityInterface
{
//    public $id;
//    public $username;
//    public $password;
//    public $authKey;
//    public $accessToken;

//
//    private static $users = [
//        '100' => [
//            'id' => '100',
//            'username' => 'admin',
//            'password' => 'admin',
//            'authKey' => 'test100key',
//            'accessToken' => '100-token',
//        ],
//        '101' => [
//            'id' => '101',
//            'username' => 'demo',
//            'password' => 'demo',
//            'authKey' => 'test101key',
//            'accessToken' => '101-token',
//        ],
//    ];

//public $email;
//связываем класс стаблицой БД для данных пользователя
public static function tableName()
{
  return 'user';

}
  /**
     * {@inheritdoc}
     */
  //поиск записи в таблице по айдишнику
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

//роли для пользователей
  const ROLE_USER = 1;
  const ROLE_MODER = 5;
  const ROLE_ADMIN = 10;


  public static function roles()
  {
    return [
      self::ROLE_USER => Yii::t('app', 'User'),
      self::ROLE_ADMIN => Yii::t('app', 'Admin'),
      self::ROLE_MODER => Yii::t('app', 'Manager'),
    ];
  }

  /**
   * Название роли
   * @param int $id
   * @return mixed|null
   */
  public function getRoleName(int $id)
  {
    $list = self::roles();
    return $list[$id] ?? null;
  }

  public function isAdmin()
  {
    return ($this->role == self::ROLE_ADMIN);
  }

  public function isManager()
  {
    return ($this->role == self::ROLE_MODER);
  }

  public function isUser()
  {
    return ($this->role == self::ROLE_USER);
  }




    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    //поиск по имени, в данном случае это почта
    public static function findByUsername($username)
    {
      return static::findOne(['username' => $username]);

//        foreach (self::$users as $user) {
//            if (strcasecmp($user['username'], $username) === 0) {
//                return new static($user);
//            }
//        }

//        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {// в таблицк наше поле записано как auth_key
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
//        return $this->password === $password;
      //пароль шифруем хэшем с помощью метода getSecurity()->validatePassword из документации Работа с паролями
      return \Yii::$app->getSecurity()->validatePassword($password, $this->password);
    }

     public function generateAuthKey(){
      //генеририрум куку для нашего поля auth_key в базе данных, при условии , что пользователь нажал галку "Запомнить меня"
      $this->auth_key = $key = Yii::$app->getSecurity()->generateRandomString();
     }
}
