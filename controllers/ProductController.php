<?php


namespace app\controllers;


use app\models\Product;
use yii\web\NotFoundHttpException;

class ProductController extends AppController
{
//создаем экшн для вывода одного товара по полученному айдишнику
  public function actionView($id){

    $product = Product::findOne($id);
    if (empty($product)){
      throw new NotFoundHttpException('Такого продукта нет...');
    }

    //задаем для страницы название и теги
    $this->setMeta("{$product->title} :: " . \Yii::$app->name, $product->keywords, $product->description);
    return $this->render('view', compact('product'));
  }

}