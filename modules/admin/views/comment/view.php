<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Comment */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Комментарии', 'url' => ['index']];
$this->params['breadcrumbs'][] = '№ '.$this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="comment-view">



    <p>
        <?= Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Удалить насовсем?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
//            'author_id',
          ['attribute' => 'author_id',
            'value' => $model->user[0]['username']],
            'text:ntext',
            'parent_id',
//            'product_id',
          ['attribute' => 'product_id',
            'value' =>
              '<a href="' . \yii\helpers\Url::to(['product/view', 'id' => $model->product->id]) . '">' .
              $model->product->title . '</a>',
            'format' => 'raw'],
            'moderate',
            'created',
            'is_admin',
        ],
    ]) ?>

</div>
