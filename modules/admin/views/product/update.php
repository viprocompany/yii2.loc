<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Product */

$this->title = 'Изменить товар: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Товары', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменение';
?>

<div class="row">
  <div class="col-md-12">
    <div class="box">
      <div class="box-body">
        <div class="product-update">
         <?php //данные ,поступающие в это представление в виде объекта модели $model рендерим в представление _form,
         // где  они будут выводится в полях формы. представление _form сгенерировано и находится в папке product
          ?>
          <?= $this->render('_form', [
            'model' => $model,
          ]) ?>

        </div>
      </div>
    </div>
  </div>
</div>
