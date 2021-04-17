<?php


namespace app\controllers;


use app\models\Comment;
use app\models\CommentForm;
use app\models\Product;
use app\modules\admin\models\Order;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

class ProductController extends AppController
{
//создаем экшн для вывода одного товара по полученному айдишнику
  public function actionView($id){
//товар, который находится на детальной странице, получаем через айдишник по ГЕТ-параметру
    $product = Product::findOne($id);
    if (empty($product)){
      throw new NotFoundHttpException('Такого продукта нет...');
    }


    //comments - объект из всех комментов в базе,который приходит на страницу товара с помощью модели класса Comment
    $comments  = Comment::find()->all();

//    $dataProvider = new ActiveDataProvider([
//      'query' => $comments,
//      //прописываем пагинацию для страницы, по 5 записи
//      'pagination' => ['pageSize' => 2],
//      //задаем сортировку вывода записей на страницу, используем  параметр sort выбираем вывод по умолчанию для  id  с встроенной константой SORT_DESC
//      'sort' => ['defaultOrder' => ['id' => SORT_DESC]],
//    ]);

    //обект для создания формы комментариев
    $commentForm = new CommentForm();

    if(\Yii::$app->request->post()){
      //загружаем данные из формы полученные ПОСТом
      $commentForm->load(\Yii::$app->request->post());
      if($commentForm->saveComment($id)){
        //флеш-сообщение пользоваателю об успешной транзакции
        \Yii::$app->session->setFlash('success', 'Ваш комментарий принят и после проверки будет опубликован!');
        return $this->redirect(["product/$id"]);
      }
    }
    //задаем для страницы название и теги, передаем объекты: product для товара , comments объект всех комментариев и  commentForm  объект  формы   добавлениякомментария к товару. объекты передадутся через вид view и оттуда их   можно передавать в файл для комментариев и их добавления
    $this->setMeta("{$product->title} :: " . \Yii::$app->name, $product->keywords, $product->description);
    return $this->render('view', compact('product', 'comments', 'commentForm', 'dataProvider'));
  }

}