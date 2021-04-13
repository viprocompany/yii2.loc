<?php


namespace app\models;


use yii\db\ActiveRecord;

class Product extends ActiveRecord
{
public static function tableName()
{
  return 'product';
}

public function getCategory(){
//используем связь один к одному hasOne, так как один продукит принадлежит одной категории и связывыаем по полю где, id категории в таблице категорий(модель Category)  будет равен category_id в таблице продуктов(модель Product)
  return $this->hasOne(Category::class, ['id' => 'category_id']);
}

//public function getProducts(){
//  return $this->hasMany()
//}
}