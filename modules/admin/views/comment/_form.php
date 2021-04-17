<?php

use app\modules\admin\models\Product;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Comment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="comment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?//= $form->field($model, 'author_id')->textInput() ?>

  <div class="form-group field-comment-author_id has-success">
    <label class="control-label" for="comment-author_id">Автор</label>
    <select id="comment-author_id" class="form-control" name="Comment[author_id]">

      <?php
      $users = \app\models\User::find()->asArray()->all();
      foreach ($users as $user): ?>
        <option value="<?= $user['id']; ?>"
          <?php //если айдишник текущего пользователя будет равен родительскому айдишнику из  свойства model,
          // , то этот опшин будет выведен в селекте?>
          <?php if($user['id'] == $model->author_id){
            echo ' selected' ;
          } ?>
        >
          <?= "{$user['username']}" ?>
        </option>
      <?php endforeach; ?>
    </select>

    <div><div class="help-block"></div></div>

  </div>

    <?= $form->field($model, 'text')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'parent_id')->textInput() ?>

    <?//= $form->field($model, 'product_id')->textInput() ?>

  <div class="form-group field-comment-product_id has-success">
    <label class="control-label" for="comment-product_id">Товар</label>
    <select id="comment-product_id" class="form-control" name="Comment[product_id]">

      <?php
      $products = Product::find()->asArray()->all();
      foreach ($products as $product): ?>
        <option value="<?= $product['id']; ?>"
          <?php //если айдишник текущей категории будет равен родительскому айдишнику из  свойства model, заданного в  компоненте Widget, то этот опшин будет выведен в селекте?>
          <?php if($product['id'] == $model->product_id){
            echo ' selected' ;
          } ?>
        >
          <?= "{$product['title']}" ?>
        </option>
      <?php endforeach; ?>

      <?//=
      //не работает c подключением свойства  selected в шаблоне вывода  и ошибку пишет , что не  видит model в шаблоне виджета,хотя модель  передается в  виджет    прямо здесь
//      \app\components\ProductWidget::Widget([
//        'tpl' => 'product',
//        'model' => $model,
//        'cache_time' => 0,
//      ]);
      ?>
    </select>

    <div><div class="help-block"></div></div>

  </div>

    <?= $form->field($model, 'moderate')->dropDownList(['Нет', 'Опубликовано']) ?>

    <?= $form->field($model, 'created')->textInput() ?>

    <?= $form->field($model, 'is_admin')->dropDownList(['Нет', 'Да']) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
  <?php

  ?>

</div>
