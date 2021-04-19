<?php
use yii\bootstrap\ActiveForm;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
//добавлять комментарии к товару могут только зарегистрированные пользователи
if (Yii::$app->user->identity):
  ?>
  <?php $form = ActiveForm::begin([
  'id' => 'comment-form',
  'layout' => 'horizontal',
  'fieldConfig' => [
    'template' => "{label}\n<div class=\"col-lg-12\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
    'labelOptions' => ['class' => 'col-lg-1 control-label'],
  ],
]) ?>
<style>
  .hidden{
    display: none;
  }


</style>
  <div class="comment-form" style="text-align: center; padding: 20px; margin: 20px;">
    <h4 style="margin: 20px;">Оставьте отзыв о товаре</h4>
    <p>Как: <?= Yii::$app->user->identity->username; ?>
    </p>
    <? //= $form->field($commentForm, 'author_id',['template' => '{input}'])->hiddenInput        (['value'=>Yii::$app->user->identity->id])
    ?>
    <?= $form->field($commentForm, 'is_admin', ['template' => '{input}'])->hiddenInput
    (['value' => Yii::$app->user->identity->role == 10 ? 1 : 0]) ?>

    <?= $form->field($commentForm, 'moderate', ['template' => '{input}'])->hiddenInput
    (['value' => Yii::$app->user->identity->role == 10 ? 1 : 0]) ?>

    <?//= $form->field($commentForm, 'parent_id')->textInput() ?>
    <?= $form->field($commentForm, 'text')->textarea(['rows' => 7]) ?>
    <? //= $form->field($commentForm, 'product_id',['template' => '{input}'])->hiddenInput(['value'=>$product->id])
    ?>

    <div class="form-group">
      <div class="col-lg-offset-1 col-lg-11">
        <div>
          <?= Html::submitButton('Комментировать', ['class' => 'btn btn-primary', 'name' => 'comment-button']) ?>
        </div>
      </div>
    </div>
  </div>
  <?php ActiveForm::end() ?>
<?php
endif;
?>

<div class="bottom-comments" style="text-align: center; padding: 20px; margin: 20px;">
  <h4 style="margin: 20px;">Отзывы к товару: <?= $product->title; ?></h4>
  <?php
  //разбираем объект со всеми комментариями поштучно на комментарии
  foreach ($comments as $comment):
    //выводим только те комментарии, котoрые принадлежат этому товару
    if ($comment->product_id == $product->id and $comment->moderate == 1):
      ?>
      <div  style="border: 1px solid darkgray;">
        <div class="post-comment" style="border: 1px solid darkgreen; margin: 10px;">
        <?php
        $parent_comment = $comment->id;
        //для вывода данных об авторе комментария используем связь из ммодели класса Comment.php
        $users = ArrayHelper::toArray($comment->user);
        foreach ($users as $user):
          ?>
          <p>Автор : <?= $user['username'] ?><?php
          //если у пользователя права с ролью 10, то он админ
          if ($user['role'] == 10):
            ?>
            <small> (Администратор)</small>
            </p>
          <?php

          endif;

        endforeach;
        ?>
        <p>Дата : <?= $comment->created ?></p>
        <p>Текст:</p>
        <p> <?= $comment->text ?></p>
        </div>



<?php
//форма для добавления комментариев к отзывам, вставляется внутри отзыва, открытие и закрытие происходит по клику  на ссылку .comment-comment ,скрипт прописан в файле main.js
?>
      <?php $form = ActiveForm::begin([
      'id' => 'comment-form-'.$comment->id,
      'layout' => 'horizontal',
      'fieldConfig' => [
        'template' => "{label}\n<div class=\"col-lg-6\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
        'labelOptions' => ['class' => 'col-lg-1 control-label'],
      ],
    ]) ?>
        <a  class="comment-comment" style="cursor: pointer" id="comment-<?= $comment->id?>">Комментировать
          как: <?= Yii::$app->user->identity->username; ?></a>
      <div id="comment-form_comment-<?= $comment->id?>"  style="text-align: center; padding: 10px; margin: 10px;"
            class="hide comment-form_comment">


        <? //= $form->field($commentForm, 'author_id',['template' => '{input}'])->hiddenInput        (['value'=>Yii::$app->user->identity->id])
        ?>
        <?= $form->field($commentForm, 'is_admin', ['template' => '{input}'])->hiddenInput
        (['value' => Yii::$app->user->identity->role == 10 ? 1 : 0]) ?>

        <?= $form->field($commentForm, 'moderate', ['template' => '{input}'])->hiddenInput
        (['value' => Yii::$app->user->identity->role == 10 ? 1 : 0]) ?>

        <?= $form->field($commentForm, 'parent_id', ['template' => '{input}'])->hiddenInput
        (['value' => $comment->id]) ?>
        <?= $form->field($commentForm, 'text')->textarea(['rows' => 7]) ?>
        <? //= $form->field($commentForm, 'product_id',['template' => '{input}'])->hiddenInput(['value'=>$product->id])
        ?>

        <div class="form-group">
          <div class="col-lg-offset-1 col-lg-11">
            <div>
              <?= Html::submitButton('Комментировать', ['class' => 'btn btn-primary', 'name' => 'comment-button']) ?>
            </div>
          </div>
        </div>
      </div>
      <?php ActiveForm::end() ?>
  <?php
  //разбираем объект со всеми комментариями поштучно на комментарии
  foreach ($comments as $comment):

    //выводим только те комментарии, котoрые принадлежат этому товару
    if ($comment->product_id == $product->id and $comment->moderate == 1 and $comment->parent_id == $parent_comment ):
      ?>
    <div class="comment-comment" style="border: 1px solid limegreen; margin: 10px 10px 10px 123px;">
      <p>Комментарий к отзыву: </p>
      <?php
      //для вывода данных об авторе комментария используем связь из ммодели класса Comment.php
      $users = ArrayHelper::toArray($comment->user);
      foreach ($users as $user):
        ?>
        <p>Автор : <?= $user['username'] ?><?php
        //если у пользователя права с ролью 10, то он админ
        if ($user['role'] == 10):
          ?>
          <small> (Администратор)</small>
          </p>
        <?php
        endif;
      endforeach;
      ?>
      <p>Дата : <?= $comment->created ?></p>
      <p>Текст:</p>
      <p> <?= $comment->text ?></p>
    </div>




    <?php
     endif;

  endforeach;

  ?>
      </div>


    <?php

     endif;

  endforeach;
  ?>

</div>

</div>



<?//="<script> document.addEventListener(\"DOMContentLoaded\", function() {
//      document.getElementById('comment-" . $comment->id."').addEventListener('click', function(event){
//        if(document.getElementById('comment-form_comment-" . $comment->id."').hasAttribute('hidden')){
//		document.getElementById('comment-form_comment-" . $comment->id."').removeAttribute('hidden');
//		} if(!(document.getElementById('comment-form_comment-" . $comment->id. "').hasAttribute('hidden'))){
//			document.getElementById('comment-form_comment-" . $comment->id."').setAttribute('hidden','');
//		}
//      })});</script>";?>


