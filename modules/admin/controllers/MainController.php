<?php


namespace app\modules\admin\controllers;


use app\models\User;
use app\modules\admin\models\Category;
use app\modules\admin\models\Comment;
use app\modules\admin\models\Order;
use app\modules\admin\models\Product;

class MainController extends AppAdminController
{
  public function actionIndex(){
    //создаем объекты классов из модели нашего модуля для получения общего количества длч заказов, товаров и  категорий, хранящихся в соответствующих таблицах БД  и  предаем их через рендер  в представление index индексной страницы шаблона админки
    $orders = Order::find()->count();
    $products = Product::find()->count();
    $categories = Category::find()->count();
    $comments = Comment::find()->count();


    return $this->render('index',compact('orders', 'products', 'categories', 'comments', 'users'));
  }

  public function actionTest(){
    return $this->render('test');
  }
}