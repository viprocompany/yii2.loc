<?php


namespace app\models;


use yii\db\ActiveRecord;

class OrderProduct extends ActiveRecord
{
 public static function tableName()
 {
   return 'order_product';
 }

  public function rules()
  {
    return [
      [['order_id', 'product_id', 'title', 'price', 'qty', 'total'], 'required'],
      [['order_id', 'product_id', 'qty'], 'integer'],
      [['price', 'total'], 'number'],
      [['title'], 'string', 'max' => 255],
    ];
  }

//  метод сохранения заказа в базу, получает параметры продутов из корзины и номер заказа
  public function saveOrderProducts($products, $order_id)
  {
    // из объекта корзины $products, полученном из параметров, в цикле готовим данные для передачи в БД
    foreach($products as $id => $product){
      //чтобы каждый раз в начале цикла у нас не оставался айдишник от предыдущего товара мы его обнуляем, иначе мы  постоянно будем сохранять один и тот же товар
      $this->id = null;
      // мы работаем  с новой записью , а не обновляем существующую, код берем их документации свойство isNewRecord  для объекта созданного с помощью  new, свойство isNewRecord = true как новая запись созданная INSERTом, а если  берется из БД =false
      $this->isNewRecord = true;
      //получаем из параметров $order_id
      $this->order_id = $order_id;
//      данные о товаре будут привязываться через ключ $id элемента $product, котрый является айдишником товара,  заполняем модель недостающими свойствами
      $this->product_id = $id;
      $this->title = $product['title'];
      $this->price = $product['price'];
      $this->qty = $product['qty'];
      $this->total = $product['qty'] * $product['price'];
      //если данные не сохранились ,то возвращаем фолс, котрый придет  в экшн actionCheckout в месте вызова метода  saveOrderProducts и  своим  значением  заставит откатить транзакцию
      if(!$this->save()){
        return false;
      }
    }
    return true;
  }
}