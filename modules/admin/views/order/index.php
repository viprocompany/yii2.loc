<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Список заказов';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
  <?php
  //верстку блока взяли из примеров таблиц в AdminLTE2 через панель разработчика скопировав и выбросив не нужное
  ?>
  <div class="col-md-12">
    <div class="box">
      <div class="box-header with-border">
        <?php //кнопку подняли сюда из-за пределов блока, так как  она была автоматически сгененрирована в этом файле при  помощи Gii, поменяли её на писание на "Добавить заказ" ?>
        <p>
          <?= Html::a('Добавить заказ', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
      </div>
      <div class="box-body">
        <div class="order-index">
          <?php //атрибуты для вывода в автоматически с помощью dataProvider из контроллера OrderController модуля(сгенерирован автоматически),сделанном виджете GridView подтянуты автоматически,если  что-то нужно  можно раскоментировать или наоборот ?>
          <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
              //нумерация записей SerialColumn, левая колонка
              ['class' => 'yii\grid\SerialColumn'],
              'id',
//                  'created_at',
              //можно выводить данные применив  к ним форматирование заданное в кофигурации в config/web.php
              //для вывода на русском нужно на локальном сервере в файле PHP_7_версия_php.ini раскомментировать строку extension = intl
              ['attribute' => 'created_at',
//                     'format' => 'datetime', ],
                //укороченный вывод названия месяца и без секунд
                'format' => ['datetime', 'php: d M Y H:i']],
              'updated_at',
              'qty',
              'total',
//                  'status',
            //форматируем вывод статуса в заваисмости от значения параметра из БД, если статус не нулевой(1), то заказ  закрыт, если статус нулевой значит новый заказ
              ['attribute' => 'status',
                'value' => function ($data) {
                  return $data->status ? '<span class="text-red">Закрыт</span>' :
                    '<span class="text-green">Новый</span>';
                },
                'format' => 'html',
              ],
              'name',
              //'email:email',
              //'phone',
              //'address',
              //'note:ntext',
// последняя правая колонка ActionColumn со значками
              ['class' => 'yii\grid\ActionColumn',
                //можно дать имя этой колонки через 'header' =>
                'header' => 'Действия',
              ],
            ],
          ]); ?>
        </div>
      </div>
    </div>
  </div>
</div>

