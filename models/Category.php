<?php


namespace app\models;


use yii\db\ActiveRecord;

class Category extends  ActiveRecord
{

  public static function tableName()
  {
    return 'category';
  }
  public function getProducts(){
//используем связь один к многим hasMany, так как в одной категории много  продукитов связывыаем пополю  где, id
//  категории в таблице категорий(модель Category)  будет равен category_id в таблице продуктов(модель Product) . По
// этой связи обратясь к объекту класса Category мы получим данные объектов Product по связи айдишника этой  категории
    return $this->hasMany(Product::class, ['category_id' => 'id']);
  }
}