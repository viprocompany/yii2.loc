<!-- products-breadcrumb -->
<div class="products-breadcrumb">
  <div class="container">
    <ul>
      <li><i class="fa fa-home" aria-hidden="true"></i><a href="<?= Yii::$app->homeUrl ?>">Home</a><span>|</span></li>
      <li>Личный кабинет</li>
    </ul>
  </div>

</div>
<!-- //products-breadcrumb -->
<!-- banner -->
<div class="banner">
  <?php
  //подключаем левое верхнее меню, которое находится в представлении layouts/inc/sidebar.php
  use yii\helpers\ArrayHelper;
  use yii\helpers\Html; ?>
<!--  --><?//= $this->render('//layouts/inc/sidebar'); ?>

  <div class="checkout-left container">
    <h3>Здравствуйте, <?php
      echo Yii::$app->user->identity->username;
      ?>!</h3>
    <br>
    <h3>Здесь вы можете увидеть все ваши заказы</h3>
    <?php
    if ($orders):

    foreach ($orders as $key => $order):
    $arr = ArrayHelper::toArray($order);
    $products = ArrayHelper::toArray($order->orderProduct);
    if ($arr['email'] == Yii::$app->user->identity->username):

//      debug($products);
      ?>
      <hr>
    <div class="container">
      <h3>Заказ № <?= $arr['id']?></h3>
      <p>Дата: <?= $arr['created_at']?></p>
      <p>Статус: <?php
        if($arr['status']){
          ?><span style="color: darkred"> <?= 'Выполнен';?></span>

          <?php
        }else{
          echo 'Новый заказ';
        }
        ?></p>
      <br>
      <h4>Товары в заказе:</h4>
      <?php
      foreach ($products as $product):
      ?>
      <p>Товар: <?= $product['title']?></p>
      <p>Артикул: <?= $product['id']?></p>
      <p> <?= $product['qty']?> шт. по <?= $product['price']?>$ = <?= $product['total']?> $</p>

      <br>
        <?php
      endforeach;
        ?>
      <p><strong> Общее количество товаров: <?= $arr['qty']?> шт.</strong> </p>
      <p><strong> Итого за заказ: <?= $arr['total']?> $</strong> </p>
      <p>Заказчик: <?= $arr['name']?></p>
      <p>Телефон: <?= $arr['phone']?></p>
      <p>Адрес доставки: <?= $arr['address']?></p>
      <p>Комментарии к заказу: <?= $arr['note']?></p>
      <hr>
    </div>
      <div class="clearfix"></div>
    <?php
    endif;
      ?>

    <?php
        endforeach;
    ?>
      <div class="clearfix"></div>
    <?php
    //если объект корзины пуст
    else: ?>
      <hr>
      <h3>Заказов нет</h3>
    <?php endif; ?>
  </div>
</div>
