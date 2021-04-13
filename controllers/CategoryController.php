<?php


namespace app\controllers;

use app\models\Category;
use app\models\Product;
use yii\data\Pagination;
use yii\web\NotFoundHttpException;
class CategoryController extends AppController
{
  public function actionView($id){
//    var_dump($id);
    $category = Category::findOne($id);
    if(empty($category)){
      throw new NotFoundHttpException('Такой категории нет...');
    }

    //задаем подтяжку названий страниц и метатегов из БД, для категорий продуктов, для вывода на странице с категорией товара
    $this->setMeta("{$category->title} ::" . \Yii::$app->name , $category->keywords, $category->description);

//    $products = Product::find()->where(['category_id' => $id])->all();

    //для пагаинации создаем объект запроса , в нем не нужно указывать
    //->all();
    $query = Product::find()->where(['category_id' => $id]);
    //задаем переменную, как объект апи-класса Pagination и предаем ему общее количество продуктов категории, полученное подсчетом записаей в объекте  $query. PageSize берем согласно примеру из документации API для определения кол-ва продуктов на странице.
    $pages = new Pagination([
      'totalCount' => $query->count(),
      //количество товаров на странице
      'pageSize' => 4,
      //параметр первой страницы, который отключает из адресной строки get-параметр page
      'forcePageParam' => false ,
      //убирает из адресной строки per-page
      'pageSizeParam' => false,
    ]);
//у объекта $query вызываем метод offset c передачей ему свойство offset объекта $pages ,и метод limit аналогично количество записей берется из pageSize(по умолчанию 10). Код взят из документации Постраничное разделение данных.
    $products = $query->offset($pages->offset)->limit($pages->limit)->all();
//    Добавим в render параметр pages для передачи  в представление view в linkPager
    return $this->render('view', compact('view', 'products','category', 'pages'));
  }

  public function actionSearch()
  {
    //создаем переменную $q, котрая будет принимать значение из формы поиска из поля под названием q, если в массиве GET будет та кой элемент  с данными.  обрезаем пробелы по краям текста запроса
    $q = trim(\Yii::$app->request->get('q'));
//debug($q);
    // установим title для страницы поиска, {$q} это данные полученные из поля поиска формы, они защищены от sql-инъекций
    $this->setMeta("Поиск: {$q} :: " . \Yii::$app->name);

    //если переменнная пуста то будет вызов представления search без передачи туда параметров
    if(!$q){
      return $this->render('search');
    }
//выборка для поиска, оператор поиска like, поле(название категории) для поиска title и папрметр(данные)$q из поля формы поиска. запись параметров сделана в массиве, как подстановка параметров в запрос, то есть данные защищены и безопасны
    $query = Product::find()->where(['like', 'title', $q]);
    //делаем пагинацию
    $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 4 , 'forcePageParam' => false, 'pageSizeParam' => false]);
    $products = $query->offset($pages->offset)->limit($pages->limit)->all();

    return $this->render('search', compact('products', 'pages', 'q'));
  }

}