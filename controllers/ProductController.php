<?php


namespace app\controllers;


use app\models\Comment;
use app\models\CommentForm;
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

    //comments of product объект из всех комментов в базе,котрый приходит на страницу товара
    $comments  = Comment::find()->all();
    //обект для создания формы комментариев
    $commentForm = new CommentForm();

    if(\Yii::$app->request->post()){
      $commentForm->load(\Yii::$app->request->post());
      if($commentForm->saveComment($id)){
        return $this->redirect(["product/$id"]);
      }
    }
    //задаем для страницы название и теги
    $this->setMeta("{$product->title} :: " . \Yii::$app->name, $product->keywords, $product->description);
    return $this->render('view', compact('product', 'comments', 'commentForm'));
  }

}