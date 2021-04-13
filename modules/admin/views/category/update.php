<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Category */

$this->title = 'Изменить категорию: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Категории', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменение';
?>


<div class="row">
  <div class="col-md-12">
    <div class="box">
      <div class="box-body">
        <div class="category-update">

          <?= $this->render('_form', [
            'model' => $model,
          ]) ?>

        </div>
      </div>
    </div>
  </div>
</div>
