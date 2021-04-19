<?php


namespace app\models;


use yii\base\Model;

class SortForm extends Model
{
  public $str;//сортировка строки по названию  или цене
  public $number;//сортировка по количеству товаров на странице



  /**
   * @return array the validation rules.
   */
  public function rules()
  {
    return [

      [['str', 'number'], 'trim'],

    ];
  }
  public function attributeLabels()
  {
//    return [
//      'str' => 'Сортировка по: ',
//      'number' => 'На странице : ',
//    ];
  }
}