<?php


namespace app\controllers;



use app\models\Category;
use app\models\Product;
use app\modules\admin\models\OrderProduct;
use Yii;
use app\modules\admin\models\Order;

class HomeController extends AppController

{
public function actionIndex(){

  //свойство для блока горячих предложений, получаем товары со свойством is_offer в количестве 4 штук для предачи(compact('offers')) в представление index контроллера HomeController
  $offers = Product::find()->where(['is_offer'=>1])->limit(4)->all();
//  debug($offers);


  return $this->render('index',compact('offers'));
}

public function actionEvents(){

  return $this->render('events');
}


  public function actionAbout(){

    return $this->render('about');
  }

  public function actionBest(){

    //свойство для блока горячих предложений, получаем товары со свойством is_offer в количестве 4 штук для предачи(compact('offers')) в представление index контроллера HomeController
    $offers = Product::find()->where(['is_offer'=>1])->limit(4)->all();

    $categories = Category::find()->limit(20)->all();
//    $model = Category->Product::findAll();


    return $this->render('best',compact('offers','categories'));
  }

  public function actionServices(){

    return $this->render('services');
  }


  public function actionProfile(){
$orders = \app\modules\admin\models\Order::find()->orderBy('id DESC')->all();

    return $this->render('profile', compact('orders'));
  }
}