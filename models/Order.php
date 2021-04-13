<?php


namespace app\models;


use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

class Order extends ActiveRecord
{

  public static function tableName()
  {
    return 'orders';
  }
//поведение   public function behaviors() взято из документации
  public function  behaviors()
  {
    return [
      [
        //указывае класс поведения к которому прикрепляем,  привязано к константе class(в документации className, но оноустарело)
        'class' => TimestampBehavior::class,
        'attributes' => [
          //событие перед вставкой записи EVENT_BEFORE_INSERT срабатывает для полей 'created_at', 'updated_at', тo есть для атрибутов , которые относятся к модели Order. Происходит во время создания заказа заполнени этих полей в виде даты и времени согласно нижепрописанной переменной 'value'
          ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
          //событие перед обновлением записи EVENT_BEFORE_UPDATE срабатывает для 'updated_at'.Происходит во время редактирования заказа, например администратором сайта, то есть происходит обновление только одного поля updated_at
          ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
        ],
        // По умолчанию происходит генерация метки времени UNIX, если вместо метки времени UNIX используется datetime, используем встроенную функцию NOW от MySql для получения текуущей даты и времени:
//        'value' => new Expression('NOW()'),
      // в письме не выводилась дата , а выводилось 'NOW()', поэтому пришлось сделать так:
        'value' => date('Y-m-d H:i:s'),
      ],
    ];
  }

//правила для полей таблицы orders
  public function rules()
  {
    return [
      //обязательные поля таблицы
      [['name', 'email', 'phone', 'address'], 'required'],
      //строка
      ['note', 'string'],
      //формат почтового ящика
      ['email', 'email'],
      //загружает поля в модели, но валидировать не будет(так как они не пользовательские , а автоматически заполняемые фреймворком), а будет только использовать в работе
      [['created_at', 'updated_at'], 'safe'],
      //целое число
      ['qty', 'integer'],
      //чсловое любое
      ['total', 'number'],
      //булевое
      ['status', 'boolean'],
    ];
  }

  //именование лейблов класса для вывода на страницу
  public function attributeLabels()
  {
    return [
      'name' => 'Имя',
      'email' => 'E-mail',
      'phone' => 'Телефон',
      'address' => 'Адрес',
      'note' => 'Примечание',
    ];
  }
}