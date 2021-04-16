<?php


namespace app\models;


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



}