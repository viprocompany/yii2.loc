<?php


namespace app\controllers;


use app\models\Cart;
use app\models\Order;
use app\models\OrderProduct;
use app\models\Product;
use Yii;
use yii\helpers\Url;

class CartController extends AppController
{
  public function actionAdd($id){

//    debug($id); die;
//создаем объект продукта по полученному id
    $product = Product::findOne($id);
    if(empty($product)){
      return false;
    }
    //если товар найден открываем сессию для хранения товара
    $session = \Yii::$app->session;
    $session->open();
    //создаем объект  модели корзины
    $cart = new Cart();
    //вызов метода модели корзины  и передаем тот продукт, что получили из базы данных
    $cart->addToCart($product);
    //проверяем с помощью компонента request, если запрос пришел аяксом, то ренедрим ответ в модальное окно cart-modal, но без применения шаблона, используем метод renderPartial  и передаем туда данные из сессии $session
    if(\Yii::$app->request->isAjax){
  return $this->renderPartial('cart-modal', compact('session'));
    }
    //если запрос пришел не аяксом то редиректим пользователя на ту страницу откуда он пришел используя referrer(нативное свойство php для массива _SERVER)
    return $this->redirect(\Yii::$app->request->referrer);
}

public function actionShow(){

  //если товар найден открываем сессию для хранения товара
  $session = \Yii::$app->session;
  $session->open();
//ренедрим  в модальное окно cart-modal, но без применения шаблона, используем метод renderPartial  и передаем туда данные из сессии $session
  return $this->renderPartial('cart-modal', compact('session'));
}

public function actionDelItem(){
    //удаление товара из корзины по айдишнику товра
//$id можно получить через параметр в скобках экшна, а можно забрать из массива GET, так как запрос был отправлен как GET
    $id = \Yii::$app->request->get('id');

  //если товар найден открываем сессию для хранения товара
  $session = \Yii::$app->session;
  $session->open();
  //создаем объект  модели корзины
  $cart = new Cart();
  //запускаем функцию для пересчета состояния корзины и передаем туда айди удаляемого товара
  $cart->recalc($id);
if( \Yii::$app->request->isAjax):
  //ЕСЛИ ЗАПРОС ПРИШЕЛ АЯКСОМ ренедрим  в модальное окно cart-modal, но без применения шаблона, используем метод
  // renderPartial  и передаем туда данные из сессии $session
 return $this->renderPartial('cart-modal', compact('session'));
else:
//  ЗАПРОС ПРИШЕЛ БЕЗ АЯКСА С ПЕРЕЗАГРУЗКОЙ СТРАНИЦЫ делаем переадресацию на страницу откуда пришел запрос
  return $this->redirect(\Yii::$app->request->referrer);
endif;
}

  public function actionClear(){
    //удаление ВСЕГО товара из корзины модального окна
    //если товар найден открываем сессию для хранения товара
    $session = \Yii::$app->session;
    $session->open();
//используем метод remove из Yii2  для очистки сессии по ключам элементов от значений
    $session->remove('cart');
    $session->remove('cart.qty');
    $session->remove('cart.sum');


    //ренедрим  в модальное окно cart-modal, но без применения шаблона, используем метод renderPartial  и передаем туда данные из сессии $session
    return $this->renderPartial('cart-modal', compact('session'));
  }

  public function actionCheckout(){
    //задаем подтяжку названий страниц и метатегов из БД, для категорий продуктов, для вывода на странице с категорией товара
    $this->setMeta("Оформление заказа ::" . \Yii::$app->name);

    //если товар найден открываем сессию для хранения товара
    $session = \Yii::$app->session;


// для работы с заказами покупателей создаем объект класса Order нашей модели, и передаем нашу модель $order в checkout представдение для создания формы данных заказчика на основе атрибутов, переданных в объекте $order
$order = new Order();
//для работы с товарамив заказе создаем объект класса Order нашей модели, и передаем нашу модель $order в checkout представдение для создания формы данных заказчика на основе атрибутов, переданных в объекте $order_product
    $order_product = new OrderProduct();

    //Создаем заказ, получаем номер заказа и по нему сохраняем продукты из корзины
//    если данные пришли и загружены в массиве пост, то есть это данные из полей формы о покупателе
if ($order->load(\Yii::$app->request->post())){
  //данные для свойств объекта заказа о общем количестве и сумме задаем как значения взятые из сессии объекта корзины
  $order->qty = $session['cart.qty'];
  $order->total = $session['cart.sum'];
  //создаем объеект транзакцию, код берем из документации Работа с базами данных Active Record Работа с транзакциями,
  // Customer меняем на \Yii$app
  $transaction = \Yii::$app->getDb()->beginTransaction();
  //если данные из объекта $order не сохранились  в базу или данные о товарах $order_product в заказе из корзины по
  //  номеру заказа $order->id при использовании метода saveOrderProducts модели=класса OrderProduct не  сохранились
//  ,то откатываемся назад
  if(!$order->save() || !$order_product->saveOrderProducts($session['cart'], $order->id)){
    //сообщение пользователю флеш-сообщением
    \Yii::$app->session->setFlash('error', 'Ошибка оформления заказа');
    //и откатываемся назад
    $transaction->rollBack();
  }else{
    //выполнение транзакцию commit
    $transaction->commit();
    //флеш-сообщение пользоваателю об успешной транзакции
    \Yii::$app->session->setFlash('success', 'Ваш заказ принят');



    //отправляем почту о создании заказа , данные отправляем в вид order, созданный в папке mail,   с параметрами  корзины из  сессии  и параметрами объекта $order заказа, котoрые тоже будут отображаться в письме  администратору и клиенту используем компонент mailer и метод compose
    //Для другого получателя нужно будет продублировать код ...mailer->compose... и внести изменения о получателе
    //отправку письма оборачиваем в блок try-catch , пытаемся отловить объект класса почты Swift_TransportException
    try{
    \Yii::$app->mailer->compose('order', ['session' => $session, 'order' => $order])
      //setFrom встроенный метод который передает информацию из config/params.php об отправителе 'senderEmail' ,  здесь настроим его как  название сайта  senderName
      ->setFrom([\Yii::$app->params['senderEmail'] => \Yii::$app->params['senderName']])
// setTo.  два одинаковых письма, одно клиенту email другое админу сайта adminEmail
      ->setTo([$order->email, \Yii::$app->params['adminEmail']])
      //тема пписьма
      ->setSubject("Заказ на сайте " . \Yii::$app->name . '  http://yii2.loc')
      //метод отправки письма send
      ->send();

    }catch (\Swift_TransportException $e){
//      if ($e)
//        echo "При сохранении данных заказа произошла ошибка: " . "<br>";
//  var_dump($e); die;
//      file_put_contents(Yii::$app->homeUrl.'mail/log.txt', $e ,  FILE_APPEND | LOCK_EX);

    }

//    очищаем корзину от данных, так как они уже попали в БД
    $session->remove('cart');
    $session->remove('cart.qty');
    $session->remove('cart.sum');
    //возвращаемся на обновленную страницу
    return $this->refresh();
  }


}


    //просмотр содержимого корзины в шаблоне на странице заказа
    return $this->render('checkout',compact('session', 'order', 'order_product'));
    $this->renderPartial('order', 'order');
  }

  //изменение количества товаров на странице оформления заказа
  public function actionChangeCart(){
     //отправленные аяксом со страницы оформления заказа переменные  из дата-атрибутов инпутов количества , получаем их из массива GET

    $id = \Yii::$app->request->get('id');
    $qty = \Yii::$app->request->get('qty');
    //создаем объект продукта
    $product = Product::findOne($id);
    //проверяем наличие объекта продукта
    if(empty($product)){
      return false;
    }
//    если продукт есть делаем изменения в сессии c помощью метода addToCart из модели класса Cart
    $session = \Yii::$app->session;
    $session->open();
    $cart = new Cart();
    $cart->addToCart($product, $qty);
    return $this->renderPartial('cart-modal', compact('session'));

  }
}