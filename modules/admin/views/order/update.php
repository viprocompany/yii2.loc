<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Order */

$this->title = 'Изменить заказ №' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Заказы', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => "Заказ № {$model->id}", 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменение';
?>
<div class="row">
  <div class="col-md-12">
    <div class="box">
      <div class="box-body">
        <div class="order-update">
          <?php
          //данные ,поступающие в это представление в виде объекта модели $model рендерим в представление _form, где  они будут выводится в полях формы. представление _form сгенерировано и находится в папке order
          ?>
          <?= $this->render('_form', [
            'model' => $model,
          ]) ?>

        </div>
      </div>
    </div>
  </div>
</div>

