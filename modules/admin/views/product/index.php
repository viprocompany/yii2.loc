<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Товары';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-md-12">
  <div class="box">
    <div class="box-header with-border">
      <?php //кнопку подняли сюда из-за пределов блока, так как  она была автоматически сгененрирована в этом файле при  помощи Gii, поменяли её на писание на "Добавить Категорию" ?>
      <p>
        <?= Html::a('Добавить товар', ['create'], ['class' => 'btn btn-success']) ?>
      </p>
    </div>
    <div class="box-body">
      <div class="product-index">
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        <?= GridView::widget([
          'dataProvider' => $dataProvider,
          'filterModel' => $searchModel,
          'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

            'id',
//            'category_id',
          ['attribute' => 'category_id',
                'value' => function ($data){
          return '<a href="' . \yii\helpers\Url::to(['category/view', 'id' => $data->category->id]) . '">' .
            $data->category->title . '</a>';
                },
            'format' => 'raw',
            ],
            'title',
//            'content:ntext',
            'price',
            'old_price',
            //'description',
            //'keywords',
            'img',
//            'is_offer',
            //форматируем вывод is_offer в заваисмости от значения параметра из БД, если статус не нулевой(1), то заказ  закрыт, если статус нулевой значит новый заказ
            ['attribute' => 'is_offer',
              'value' => function ($data) {
                return $data->is_offer ? '<span class="text-green">ДА</span>' :
                  '<span class="text-red">Нет</span>';
              },
              'format' => 'raw',
              ],
            ['class' => 'yii\grid\ActionColumn'],
          ],
        ]); ?>


      </div>
    </div>
  </div>
</div>
