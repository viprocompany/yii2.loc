<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Product */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Товары', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<div class="col-md-12">
  <div class="box">
    <div class="box-header with-border">
      <?php //кнопку подняли сюда из-за пределов блока, так как  она была автоматически сгененрирована в этом файле   при  помощи Gii, поменяли её на писание на "... Категорию" ?>
      <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
          'class' => 'btn btn-danger',
          'data' => [
            'confirm' => 'Вы уверены, что хотите удалить этот товар ?',
            'method' => 'post',
          ],
        ]) ?>
      </p>
    </div>
    <div class="product-view">

      <h1><?= Html::encode($this->title) ?></h1>

      <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
          'id',
//          'category_id',
        //для категории выводим её название из объекта
          ['attribute' =>
            'category_id',
            'value' =>
              '<a href="' . \yii\helpers\Url::to(['category/view', 'id' => $model->category->id]) . '">' .
              $model->category->title . '</a>',
            'format' => 'raw',
          ],
          'title',
          'content:html',
//          'content:ntext',
          'price',
          'old_price',
          'description',
          'keywords',
           ['attribute' =>  'img',
           // в свойстве img  модели $model хранится полный путь к папке для хранения файлов, полученный при помещении в БД
           'value' => "/{$model->img}" ,
             //для изображения применяем специальное форматирование с указанием адреса и размера
           'format' => ['image', ['width' => '100px']],
           ],
//          'img',
//          'is_offer',
          //форматируем вывод is_offer в заваисмости от значения параметра из БД, если статус не нулевой(1), то заказ  закрыт, если статус нулевой значит новый заказ
          ['attribute' => 'is_offer',
            'value' => function ($model) {
              return $model->is_offer ? '<span class="text-green">ДА</span>' :
                '<span class="text-red">Нет</span>';
            },
            'format' => 'raw',
          ],
        ],
      ]) ?>

    </div>
  </div>
</div>
