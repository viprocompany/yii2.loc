<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\CommentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Комментарии';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comment-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить комментарий', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

            'id',
//            'author_id',

          ['attribute' => 'author_id',
            'value' => function ($data) {
                foreach (ArrayHelper::toArray($data->user) as $user):
                  return ($user['username']);
                endforeach;
              }],
            'text:ntext',
            'parent_id',
//            'product_id',
          ['attribute' => 'product_id',
            'value' => function ($data) {
              foreach (ArrayHelper::toArray($data->product) as $product):
                return ($product['title']);
              endforeach;
            }],
//            'moderation',
          //форматируем вывод moderation в заваисмости от значения параметра из БД, если статус не нулевой(1), то
          // проверено и разрешено к публикации,
          ['attribute' => 'moderate',
            'value' => function ($data) {
              return $data->moderate ? '<span class="text-green">ДА</span>' :
                '<span class="text-red">Нет</span>';
            },
            'format' => 'raw',
          ],
            'created',
//            'is_admin',
          //форматируем вывод moderation в заваисмости от значения параметра из БД, если статус не нулевой(1), то
          // это пользователь с правами админа
          ['attribute' => 'is_admin',
            'value' => function ($data) {
              return $data->is_admin ? '<span class="text-green">ДА</span>' :
                '<span class="text-red">Нет</span>';
            },
            'format' => 'raw',
          ],
        //смотрим роль пользователя в таблице user, если роль равна 19, то это чел с админправами
//          ['attribute' => 'is_admin',
//            'value' => function ($data) {
//              foreach (ArrayHelper::toArray($data->user) as $user):
//                return $user['role'] ==10 ? '<span class="text-green">ДА</span>' :
//                  '<span class="text-red">Нет</span>';
//              endforeach;
//            },
//            'format' => 'raw',
//          ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
