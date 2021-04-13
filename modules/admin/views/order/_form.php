<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Order */
/* @var $form yii\widgets\ActiveForm */
?>
<?php
//данные приходят в  объекте модели $model из экшна actioUpdate контроллера  OrderController
?>
<div class="order-form">
  <?php //зададим fieldConfig и в нем темплейт для вывода полей формы для редактирования в ctiveForm::begin(); Будем
  //  использовать дивы, в параграфы которых мы разместим лэйблы, которые будут принадлежать полям-инпутам
  //  сгенерирванной формы, эти инпуты мы разместим сразу за параграфами, а за каждым полем мы добавим див для вывода  ошибок   ?>
    <?php $form = ActiveForm::begin([
        'fieldConfig' => [
            'template' => "<div class=\"col-md-6\">
  <p>{label}</p> \n {input} \n
  <div>{error}</div>
</div>",
        ]
    ]); ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'qty')->textInput() ?>

    <?= $form->field($model, 'total')->textInput(['maxlength' => true]) ?>
  <?php
  //для статуса можно сделать выпадающий список, а учитывая, что у нас только два значения можно просто их  перечислить без массива ключ/значение
  ?>
    <?= $form->field($model, 'status')->dropDownList(['Новый заказ', 'Заказ закрыт']) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


