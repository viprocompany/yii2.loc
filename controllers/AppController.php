<?php


namespace app\controllers;


use yii\web\Controller;

class AppController extends Controller
{
  //метод будет срабатывать перед любым экшеном, типа события битрикса
public function beforeAction($action)
{
  //временное решение, которое можно применить для подстановки в title всех страниц сайта названия сайта из переменной name , заданной в файле web config, получаем как свойство объекта \Yii::$app-
  $this->view->title =\Yii::$app->name;
  return parent::beforeAction($action);
}
//задаем теги на страницу
public function setMeta($title = null, $keywords = null, $description = null){
//обращаемся к компонету view и его свойству title и задаем переданный в параметре $title при вызове метода setMeta"
  $this->view->title = $title;
  //аналогично регистрирум теги
  $this->view->registerMetaTag(['name'=> 'keywords', 'content' => "$keywords"]);
  $this->view->registerMetaTag(['name'=> 'description', 'content' => "$description"]);
}

}