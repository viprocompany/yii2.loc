<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Order */
// Настраиваем вывод информации   на русском языке и тайтл страницы
//$this->title = $model->name;
$this->title = 'Заказ № ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Заказы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="col-md-12">
  <div class="box">
    <div class="box-header with-border">
          <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
          'class' => 'btn btn-danger',
          'data' => [
            'confirm' => 'Вы уверены, что хотите удалить данный заказ?',
            'method' => 'post',
          ],
        ]) ?>
      </p>
    </div>
    <div class="box-body">
      <div class="order-view">
        <?php
        //данные в виджет DetailView приходят в виде объекта модели $model из контроллера OrderController/actionView
        ?>
        <?= DetailView::widget([
          'model' => $model,
          'attributes' => [
            'id',
            //настраеиваем формат вывода даты
            'created_at:datetime',
            'updated_at:datetime',
            'qty',
            'total',
//            'status',
            //форматируем вывод статуса в заваисмости от значения параметра из БД в объекте модели $model, если  статус не  нулевой(1), то заказ  закрыт, если статус нулевой значит новый заказ
            ['attribute' => 'status',
              'value' => $model->status ? '<span class="text-red">Заказ закрыт</span>' :
                '<span class="text-green">Новый заказ</span>',
              'format' => 'html',
            ],
            'name',
            'email',
            'phone',
            'address',
          //текст в несколько строк, а не  в одну
            'note:ntext',
          ],
        ]) ?>

      </div>
    </div>
  </div>
</div>
<?php
//непонятно как работает магический метод orderProduct, запускает метод getOrderProduct из модели Order?
$items = $model->orderProduct ?>

<div class="row">
  <div class="col-md-12">
    <div class="box">
      <div class="box-header with-border">
        <h3>Товары в заказе</h3>
      </div>
      <div class="box-body">
        <table class="table table-hover table-striped">
          <thead>
          <tr>
            <th>ID</th>
            <th>Наименование</th>
            <th>Кол-во</th>
            <th>Цена</th>
            <th>Сумма</th>
          </tr>
          </thead>
          <tbody>
          <?php //проходим циклом массив товаров в корзине , ключами делаем айдишник товара , а значением массив цена,количество, картинка,название
          foreach ($items

          as $id => $item): ?>
          <tr>
            <td><?= $item->id; ?></td>
            <td><?= $item->title; ?></td>
            <td><?= $item->qty; ?></td>
            <td><?= $item->price; ?></td>
            <td><?= $item->total; ?></td>
            <?php endforeach ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

