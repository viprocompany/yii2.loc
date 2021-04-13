<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Order */

$this->title = 'Создание заказ';
$this->params['breadcrumbs'][] = ['label' => 'Заказы', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Создание';
?>

<div class="row">
  <div class="col-md-12">
    <div class="box">
      <div class="box-body">
        <div class="order-create">
          <?php
          //данные , _form, где  они будут задаваться в полях формы. представление _form сгенерировано и находится в   папке order
          ?>
          <?= $this->render('_form', [
            'model' => $model,
          ]) ?>

        </div>
      </div>

    </div>
  </div>
</div>