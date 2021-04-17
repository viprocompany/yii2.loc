<?php


namespace app\models;


use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

class Comment extends ActiveRecord
{
  //сделал модель для комментариев к товарам на детальной странице товара
  public static function tableName()
  {
    return 'comment';
  }


  public function getUser(){
//используем связь один к многим hasMany, так как в одном товаре много  комментариев связывыаем пополю  где, id товара в таблице пользователей(модель User)  будет равен author_id в таблице коммментариев(модель Comment) . По
// этой
// связи обратясь к объекту класса Product мы получим данные объектов Comment по связи айдишника этого  товара
    return $this->hasMany(User::class, ['id' => 'author_id']);
  }
  public function  behaviors()
  {
    return [
      [
        //указывае класс поведения к которому прикрепляем,  привязано к константе class(в документации className, но оноустарело)
        'class' => TimestampBehavior::class,
        'attributes' => [
          //событие перед вставкой записи EVENT_BEFORE_INSERT срабатывает для полей 'created',  тo есть для атрибутов которые относятся к модели Comment. Происходит во время создания заказа заполнени этих полей в виде даты и времени согласно нижепрописанной переменной 'value'
          ActiveRecord::EVENT_BEFORE_INSERT => ['created'],
        ],
        // По умолчанию происходит генерация метки времени UNIX, если вместо метки времени UNIX используется datetime, используем встроенную функцию NOW от MySql для получения текуущей даты и времени:
//        'value' => new Expression('NOW()'),
        // в письме не выводилась дата , а выводилось 'NOW()', поэтому пришлось сделать так:
        'value' => date('Y-m-d H:i:s'),
      ],
    ];
  }


}
