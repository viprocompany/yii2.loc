<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'КАтегории';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="col-md-12">
  <div class="box">
    <div class="box-header with-border">
      <?php //кнопку подняли сюда из-за пределов блока, так как  она была автоматически сгененрирована в этом файле при  помощи Gii, поменяли её на писание на "Добавить Категорию" ?>
      <p>
        <?= Html::a('Добавить категорию', ['create'], ['class' => 'btn btn-success']) ?>
      </p>
    </div>
    <div class="box-body">
      <div class="category-index">
        <?php //атрибуты для вывода в автоматически с помощью dataProvider из контроллера CategoryController модуля
        //(сгенерирован автоматически),сделанном виджете GridView подтянуты автоматически,если  что-то нужно  можно раскоментировать или наоборот ?>
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <?= GridView::widget([
          'dataProvider' => $dataProvider,
          'filterModel' => $searchModel,
          'columns' => [
              // закомментировал порядковй номер строки на страннице, так как они совпадают с айдишниками категорий
//            ['class' => 'yii\grid\SerialColumn'],

            'id',
//            'parent_id',
            ['attribute' => 'parent_id',
              'value' => function($data){
          //если значение не нулевое вытаскиваем название категории из объекта $data,  если нет , то выведем 'Самостоятельная категория'
return $data->category->title ?? 'Самостоятельная категория';
              }
              ],
            'title',
//            'description',
//            'keywords',

            ['class' => 'yii\grid\ActionColumn'],
          ],
        ]); ?>
      </div>
    </div>
  </div>
</div>


