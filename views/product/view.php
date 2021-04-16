<!-- products-breadcrumb -->
<div class="products-breadcrumb">
  <div class="container">
    <ul>
      <li><i class="fa fa-home" aria-hidden="true"></i><a href="<?= Yii::$app->homeUrl ?>">Home</a><span>|</span></li>
      <?php
//      debug($product);
      //вывод категории товара родителя, с помощью метода getCategory из модели product?>
<li>
  <?php
  //маршрут категории category/view, параметр это id категории и  $product его виртуальное свойство category, которого по  факту нет, но оно берется из связи в методе getCategory модели Product получаем объект category , у кторого есть свойства id и title
  ?>
  <a href="<?= \yii\helpers\Url::to(['category/view','id' => $product->category->id]);?>">
    <?=$product->category->title?></a>

  <?php
  //можно делать cсылку с хелпером HTML
  ?>
<!--  --><?//=
//  \yii\helpers\Html::a($product->category->title
//  , ['category/view', 'id' => $product->category->id]);
//  ?>
  <span>|</span>
</li>
      <li><?= $product->title; ?></li>
    </ul>
  </div>
</div>
<!-- //products-breadcrumb -->


<!-- banner -->
<div class="banner">
  <?php
  //подключаем левое верхнее меню, которое находится в представлении layouts/inc/sidebar.php
  use app\models\Category;
  use yii\bootstrap\ActiveForm;
  use yii\helpers\ArrayHelper;
  use yii\helpers\Html; ?>
  <?= $this->render('//layouts/inc/sidebar');?>

  <div class="w3l_banner_nav_right">
    <div class="w3l_banner_nav_right_banner3">
      <h3>Best Deals For New Products<span class="blink_me"></span></h3>
    </div>
    <div class="agileinfo_single">
<!--      название-->
      <h5><?=$product->title;?></h5>
      <div class="col-md-4 agileinfo_single_left">
<!--        картинка-->
        <?php //картинку получаем с хелпером из свойства img, которе отдает полный путь к картинке товара, потому что это свойство быыло задано в модуле админпанели в модели товаров modules/admin/models/Product.php  в методе beforeSave для созданияимени файла и пути к нему ?>
        <?=  Html::img("@web/{$product->img}", [
          'alt' => "$product->title" , 'id' =>'example', 'class' =>'img-responsive']) ?>

<!--        <img id="example" src="--><?//=$product->img;?><!--" alt=" " class="img-responsive" />-->
      </div>
      <div class="col-md-8 agileinfo_single_right">
        <div class="rating1">
						<span class="starRating">
							<input id="rating5" type="radio" name="rating" value="5">
							<label for="rating5">5</label>
							<input id="rating4" type="radio" name="rating" value="4">
							<label for="rating4">4</label>
							<input id="rating3" type="radio" name="rating" value="3" checked>
							<label for="rating3">3</label>
							<input id="rating2" type="radio" name="rating" value="2">
							<label for="rating2">2</label>
							<input id="rating1" type="radio" name="rating" value="1">
							<label for="rating1">1</label>
						</span>
        </div>
        <div class="w3agile_description">
          <h4>Description :</h4>
          <p><?= $product->content; ?></p>
        </div>
        <div class="snipcart-item block">
          <div class="snipcart-thumb agileinfo_single_right_snipcart">
            <h4>$<?= $product->price; ?>
              <?php
              if((float)$product->old_price):
              ?>
              <span>$<?= $product->old_price; ?></span></h4>
            <?php
            endif;
            ?>
          </div>
          <div class="snipcart-details agileinfo_single_right_details">
            <?php // переход по ссылке в корзину с помощью хелпера, переход осуществляется в экшн контроллера по айдишнику горячего предложения. Параметр  в теге для аякс запроса: айдишник товара ,кроме класса button из вёрстки  добавляем наш класс   add-to-cart для работы со скриптом аякс    ?>
            <a href="<?= \yii\helpers\Url::to(['cart/add', 'id' => $product->id])?>" class="button add-to-cart" data-id="<?= $product->id;?>">В корзину</a>

          </div>
        </div>
      </div>
      <div class="clearfix"> </div>
    </div>
  </div>
  <div class="clearfix"></div>
  <?php
  //вывод комментариев к товару
  ?>
  <div class="comment-form" style="text-align: center; padding: 20px; margin: 20px;">
    <h4 style="margin: 20px;">Оставьте комментарий о товаре</h4>
    <?php $form = ActiveForm::begin([
      'id' => 'comment-form',
      'layout' => 'horizontal',
      'fieldConfig' => [
        'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
        'labelOptions' => ['class' => 'col-lg-1 control-label'],
      ],
    ]) ?>
    <p>Пользователь: <?= Yii::$app->user->identity->username;?>
    </p>
        <?//= $form->field($commentForm, 'author_id',['template' => '{input}'])->hiddenInput        (['value'=>Yii::$app->user->identity->id])?>
    <?= $form->field($commentForm, 'is_admin',['template' => '{input}'])->hiddenInput
    (['value'=>Yii::$app->user->identity->role==10 ? 1 : 0])?>

    <?= $form->field($commentForm, 'moderate',['template' => '{input}'])->hiddenInput
    (['value'=>Yii::$app->user->identity->role==10 ? 1 : 0])?>

    <?= $form->field($commentForm, 'parent_id')->textInput() ?>
        <?= $form->field($commentForm, 'text')->textarea(['rows' => 7]) ?>
    <?//= $form->field($commentForm, 'product_id',['template' => '{input}'])->hiddenInput(['value'=>$product->id]) ?>

    <div class="form-group">
      <div class="col-lg-offset-1 col-lg-11">
        <div>
          <?= Html::submitButton('Комментировать', ['class' => 'btn btn-primary', 'name' => 'comment-button']) ?>
        </div>
      </div>
    </div>
  </div>
  <?php ActiveForm::end() ?>
  </div>
  <div class="bottom-comments" style="text-align: center; padding: 20px; margin: 20px;">
    <h4 style="margin: 20px;">Комментарии к товару <?= $product->title;?></h4>
    <?php
    //разбираем объект со всеми комментариями поштучно на комментарии
    foreach ($comments as $comment):
      //выводим только те комментарии, котoрые принадлежат этому товару
if ($comment->product_id == $product->id):
  //для вывода данных об авторе комментария используем связь из ммодели класса Comment.php
      $users = ArrayHelper::toArray($comment->user);
    foreach ($users as $user):
    ?>
<p>Автор : <?= $user['username']?> <?php
    //если у пользователяправа с ролью 10, то он админ
      if($user['role']==10):
        ?>
        <p><strong>Администратор</strong></p>
      <?php
        endif;
        ?>
      </p>

      <?php
    endforeach;
      ?>

      <p>Дата : <?= $comment->created?></p>
<p>Комментарий: <?= $comment->text?></p>
      <hr>

    <?php
    endif;

    endforeach;
    ?>

  </div>
</div>
<!-- //banner -->