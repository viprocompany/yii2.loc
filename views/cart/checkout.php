<!-- products-breadcrumb -->
<div class="products-breadcrumb">
  <div class="container">
    <ul>
      <li><i class="fa fa-home" aria-hidden="true"></i><a href="<?= Yii::$app->homeUrl ?>">Home</a><span>|</span></li>
      <li>Оформление заказа</li>
    </ul>
  </div>
</div>
<!-- //products-breadcrumb -->
<!-- banner -->
<div class="banner">
  <?php //подключаем левое верхнее меню, которое находится в представлении layouts/inc/sidebar.php
  use yii\helpers\Html; ?>
  <?= $this->render('//layouts/inc/sidebar');?>

  <div class="w3l_banner_nav_right">
    <!-- about -->
    <div class="privacy about">

      <?php
      //просмотр ошибок при отказе от транзакции можно сделать просмотрев ошибки валидации объектов данных заказчика  и товаров в заказе
//      debug($order->errors);
//      debug($order_product->errors)

      ?>
<!--вывод флеш-сообщений пользователям-->
      <?= \app\widgets\Alert::widget() ?>

      <h3>Check<span>out </span></h3>
      <?php

      //проверяем есть ли объект корзины
      if(!empty($session['cart'])):
      ?>
      <div class="checkout-right">

        <?php
        //количесво продуктов в корзине
        ?>
        <h4>Your shopping cart contains: <span><?= $session['cart.qty']?> Products</span></h4>
<!--добавляем в вертку обертку для таблицы с классом cart-table -->
        <div class="cart-table">
<!--и в обертку сдобавим оверлей, котрый будет закрывать собой таблицу во время отправки данных на сервер об удалении
  позиции или других изменениях в таблице  -->
          <div class="overlay">
<!--            добавляем иконку спинер из фонт-осума, который у нас подключен из верстки для отображения по центру
оверлея, с классом fa-spin(чтоб крутился)-->
            <i class="fa fa-refresh fa-spin"></i>
          </div>
          <table class="timetable_sub">
            <thead>
            <tr>
              <th>SL No.</th>
              <th>Product</th>
              <th>Quant ity</th>
              <th>Product Name</th>
              <th>Price</th>
              <th>Remove</th>
            </tr>
            </thead>
            <tbody>
            <?php //проходим циклом массив товаров в корзине , ключами делаем айдишник товара , а значением массив цена,количество, картинка,название
            //задаем счетчик $i для номера позиции овара в общем списке продуктов корзины, который буде в конце каждого
            // цикла добавлять 1 $i++;
            $i = 1;
            foreach($session['cart'] as $id => $item):?>
              <tr class="rem1">
                <td class="invert"><?= $i;?></td>
                <td class="invert-image"><a href="<?= \yii\helpers\Url::to(['product/view', 'id' => $id]);?>">
  <?php //картинку получаем с хелпером из свойства img, которе отдает полный путь к картинке товара, потому что это свойство быыло задано в модуле админпанели в модели товаров modules/admin/models/Product.php  в методе beforeSave для созданияимени файла и пути к нему ?>
                    <?= \yii\helpers\Html::img("@web/{$item['img']}", ['alt' => $item['title'], 'height' => 140, 'class' => 'img-responsive']) ?>
                    <!--                <img src="images/1.png" alt=" " class="img-responsive">-->
                  </a>
                </td>
                <td class="invert">
                  <div class="quantity">
                    <div class="quantity-select">
                      <?php //задаем дата атрибут инпуту для возможности изменять значение переменной $qty для пересчета количества товара в корзине по айдишнику в атрибуте data-id?>
                      <div class="entry value-minus" data-qty="-1" data-id="<?= $id;?>">&nbsp;</div>
                      <div class="entry value"><span><?= $item['qty']?></span></div>
                      <div class="entry value-plus active" data-qty="1" data-id="<?= $id;?>">&nbsp;</div>
                    </div>
                  </div>
                </td>
                <td class="invert"><?= $item['title']?></td>

                <td class="invert">$<?= $item['price']?></td>
                <td class="invert">
                  <div class="rem">
                    <?php //делаем ссылку для удаления товара по айдишника передачей айдишника контроллеру
                    // CartController  в экшн actionDelItem ?>
                    <a href="<?= \yii\helpers\Url::to(['cart/del-item' , 'id' => $id]); ?>" class="close1"></a>
                  </div>
                </td>
              </tr>
              <!--вывод товаров корзины-->
              <?php
              //увеличение счетчика- номера позиции товара в общем списке товаров корзины
              $i++;
            endforeach; ?>
            </tbody></table>
        </div>
      </div>
      <div class="checkout-left">
        <div class="col-md-4 checkout-left-basket">
          <h4>Continue to basket</h4>
          <ul>
            <?php // с помощью цикла делаем итоговый подсчет сумм по каждому пункту заказ и общей сумме денег
            foreach($session['cart'] as $item):?>
            <li><?= $item['title']?><i>-</i> <span>$<?= $item['price'] * $item['qty'];?></span></li>
            <?php   endforeach;?>
            <li>Total <i>-</i> <span>$<?= $session['cart.sum']?></span></li>
          </ul>
        </div>
        <div class="col-md-8 address_form_agile">
          <h4>Данные покупателя</h4>
          <?php $form = \yii\widgets\ActiveForm::begin()
          //получаем данные объекта $order из контроллера CartController экшна actionCheckout
          ?>
          <?= $form->field($order, 'name') ?>
          <?= $form->field($order, 'email') ?>
          <?= $form->field($order, 'phone') ?>
          <?= $form->field($order, 'address') ?>
          <?= $form->field($order, 'note')->textarea(['rows' => 5]) ?>
          <?php  //для кнопки используем хелпер, класс 'class' => 'submit check_out' берем из верстки   ?>
          <?= \yii\helpers\Html::submitButton('Заказать', ['class' => 'submit check_out']) ?>
          <?php \yii\widgets\ActiveForm::end();
//          debug($order);
          ?>


<!--          <form action="payment.html" method="post" class="creditly-card-form agileinfo_form">-->
<!--            <section class="creditly-wrapper wthree, w3_agileits_wrapper">-->
<!--              <div class="information-wrapper">-->
<!--                <div class="first-row form-group">-->
<!--                  <div class="controls">-->
<!--                    <label class="control-label">Full name: </label>-->
<!--                    <input class="billing-address-name form-control" type="text" name="name" placeholder="Full name">-->
<!--                  </div>-->
<!--                  <div class="w3_agileits_card_number_grids">-->
<!--                    <div class="w3_agileits_card_number_grid_left">-->
<!--                      <div class="controls">-->
<!--                        <label class="control-label">Mobile number:</label>-->
<!--                        <input class="form-control" type="text" placeholder="Mobile number">-->
<!--                      </div>-->
<!--                    </div>-->
<!--                    <div class="w3_agileits_card_number_grid_right">-->
<!--                      <div class="controls">-->
<!--                        <label class="control-label">Landmark: </label>-->
<!--                        <input class="form-control" type="text" placeholder="Landmark">-->
<!--                      </div>-->
<!--                    </div>-->
<!--                    <div class="clear"> </div>-->
<!--                  </div>-->
<!--                  <div class="controls">-->
<!--                    <label class="control-label">Town/City: </label>-->
<!--                    <input class="form-control" type="text" placeholder="Town/City">-->
<!--                  </div>-->
<!--                  <div class="controls">-->
<!--                    <label class="control-label">Address type: </label>-->
<!--                    <select class="form-control option-w3ls">-->
<!--                      <option>Office</option>-->
<!--                      <option>Home</option>-->
<!--                      <option>Commercial</option>-->
<!---->
<!--                    </select>-->
<!--                  </div>-->
<!--                </div>-->
<!--                <button class="submit check_out">Delivery to this Address</button>-->
<!--              </div>-->
<!--            </section>-->
<!--          </form>-->

          <div class="checkout-right-basket">
            <a href="payment.html">Make a Payment <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span></a>
          </div>
        </div>

        <div class="clearfix"> </div>

      </div>

        <?php
      //если объект корзины пуст
      else:   ?>
      <h3>Корзина пуста</h3>
      <?php endif;  ?>

    </div>
    <!-- //about -->
  </div>
  <div class="clearfix"></div>
</div>
<!-- //banner -->