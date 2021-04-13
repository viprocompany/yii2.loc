<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Регистрация';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-login">
  <h1><?= Html::encode($this->title) ?></h1>

  <p>Пожалуйста введите данные вашего почтового ящика и выберите пароль для регистрации:</p>

  <?php $form = ActiveForm::begin([
    'id' => 'signup-form',
    'layout' => 'horizontal',
    'fieldConfig' => [
      'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
      'labelOptions' => ['class' => 'col-lg-1 control-label'],
    ],
  ]) ?>

  <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
  <?= $form->field($model, 'password')->passwordInput() ?>
  <div class="form-group">
    <div class="col-lg-offset-1 col-lg-11">
    <div>
      <?= Html::submitButton('Регистрация', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
    </div>
    </div>
  </div>
</div>
<?php ActiveForm::end() ?>
