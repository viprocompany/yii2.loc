<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div class="login-box">

  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>
    <?php
//создаем форму с помощью виджета
    $form = \yii\widgets\ActiveForm::begin();
    //$model приходит из контроллера AuthController и является объектом класса LoginForm
//создаем поле имэйла для объекта модели $model класса-модели LoginForm(там email прописан как свойство), данные  для  {input} вводим в методе  textInput, для вывода предупреждений про), данные для {input} вводим в методе  textInput,  для вывода  предупреждений прописывае  <div>{error}</div>
    echo $form->field($model, 'username', ['template' => "<div class='form-group has-feedback'> {input} <span class=\"glyphicon glyphicon-user form-control-feedback\"></span><div>{error}</div></div>",])->textInput(['placeholder' => 'Введите вашу почту', 'class'=> "form-control"]
    );
    //создаем поле пароля для объекта модели $model класса-модели LoginForm(там password прописан как свойство), данные  для {input} вводим в методе  textInput, для вывода предупреждений прописываем   <div>{error}</div>
    echo $form->field($model, 'password', ['template' => "<div class='form-group has-feedback'> {input} <span class=\"glyphicon glyphicon-lock form-control-feedback\"></span><div>{error}</div></div>",])->passwordInput(['placeholder' => 'Введите ваш пароль', 'class'=> "form-control"]
    );
    //правила валидации полей формы авторизации заданы в классе модели LoginForm в rules
    ?>
<!--    <form action="../../index2.html" method="post">-->
<!--      <div class="form-group has-feedback">-->
<!--        <input type="email" class="form-control" placeholder="Email">-->
<!--        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>-->
<!--      </div>-->
<!--      <div class="form-group has-feedback">-->
<!--        <input type="password" class="form-control" placeholder="Password">-->
<!--        <span class="glyphicon glyphicon-lock form-control-feedback"></span>-->
<!--      </div>-->
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
<!--           для объекта модели $model класса-модели LoginForm(там rememberMe прописан как свойство), )создаем поле для чекбокса "запомнить меня"-->
<!--   название лейбла для чекбокса "Запомнить меня" задано в модели LoginForm  в методе attributeLabels для свойства rememberMe
     -->
            <?= $form->field($model, 'rememberMe')->checkbox([
              'template' => "{label} {input}"]); ?>
<!--            <label>-->
<!--              <input type="checkbox"> Запомнить меня-->
<!--            </label>-->
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <?php
          //         для кнопки используем хелпер, добавляем атрибут name
          ?>
          <?= \yii\helpers\Html::submitButton('Login', ['class'=>'btn btn-primary btn-block btn-flat',
            'name'=>'login-button'])?>
<!--          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>-->
        </div>
        <!-- /.col -->
      </div>
<!--    </form>-->
    <?php
    ActiveForm::end();
    ?>


<!--    <a href="#">I forgot my password</a><br>-->
<!--    <a href="register.html" class="text-center">Register a new membership</a>-->

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->



