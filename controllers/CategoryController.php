<?php


namespace app\controllers;

use app\models\Category;
use app\models\Product;
use app\models\SortForm;
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




    //задаем переменную для возможности вывода товаров списком , а не сеткой как по умолчанию  ипередаем её в
    // представление
    if(isset($_GET['list']) && ($_GET['list'] ==1 )):
    $list = 1;
    else:
      $list = 0;
    endif;
//создаем модель для передачи данных для сортировки товаров на странице по цене названию  и количеству от модели
// класса формы сортировки SortForm
    $model = new SortForm();
    $str =null; //параметры для сортировки по цени или названию
    $number = 4;//параметр для пагинации по умолчанию, в селекте в опшинах прописаны  значения 4 8 12 и 20

    if ($model->load(\Yii::$app->request->post()) && $model->validate()){
      //данные с формы уходят, объект остается
      //debug($model);
      //получаем данные со страницы категории товаров из формы и присваиваем их свойству number нашей модели формы
      // $model для получения количества товаров при пагинации
      $number = $model->number;
      //данные полученные из опшина селектора прроопускаем через свитч для определения типа и направления сортировки
      // товара
      if(isset($model->str)){
        switch ($model->str){
          case 0 :
            $str = ['price' => SORT_ASC];
            break;
            case 1 :
              $str = ['price' => SORT_DESC];
            break;
            case 2 :
              $str = ['title' => SORT_ASC];
            break;
            case 3 :
              $str = ['title' => SORT_DESC];
            break;
            case 4 :
              $str = ['id' => SORT_ASC];
            break;
            case 5 :
              $str = ['id' => SORT_DESC];
            break;
            default :
              $str = ['id' => SORT_DESC];
            break;

        }
      }
    }

    //для пагаинации создаем объект запроса , в нем не нужно указывать
    //->all();
    //для orderBy($str) значение $str получаем со страницы после выборки в свитче сверху
    $query = Product::find()->where(['category_id' => $id])->orderBy($str);
    //задаем переменную, как объект апи-класса Pagination и предаем ему общее количество продуктов категории, полученное подсчетом записаей в объекте  $query. PageSize берем согласно примеру из документации API для определения кол-ва продуктов на странице.
    $pages = new Pagination([
      'totalCount' => $query->count(),
      //количество товаров на странице ,получаем из переменной $number = $model->number; в выпадающем списке на странице
      'pageSize' => $number,
      //параметр первой страницы, который отключает из адресной строки get-параметр page
      'forcePageParam' => false ,
      //убирает из адресной строки per-page
      'pageSizeParam' => false,
    ]);
//у объекта $query вызываем метод offset c передачей ему свойство offset объекта $pages ,и метод limit аналогично количество записей берется из pageSize(по умолчанию 10). Код взят из документации Постраничное разделение данных.
    $products = $query->offset($pages->offset)->limit($pages->limit)->all();
    //    Добавим в render параметр pages для передачи  в представление view в linkPager

    return $this->render('view', compact('view', 'products','category', 'pages' ,'list' , 'model'));
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