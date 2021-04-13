<?php
use app\assets\AppAsset;
use yii\helpers\Html;

//подключаем все ресурсы
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
  <?php
  //корневая папка для ссылкок картинок, будет добавляться ко всем путям
  ?>
  <base href="/">
  <meta charset="<?= Yii::$app->charset ?>">
  <?php $this->registerCsrfMetaTags() ?>
  <title><?= Html::encode($this->title) ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php $this->head() ?>




</head>

<body>
<?php $this->beginBody() ?>

<?php
//ищем ссылку домашней страницы для встаки в ссылку главной страницы
//debug(Yii::$app->homeUrl);
?>
<!-- header -->
<div class="agileits_header">
  <div class="w3l_offers">
    <a href="products.html">Today's special Offers !</a>
  </div>
  <div class="w3l_search">
    <?php
    //задаем хелпер Url в action формы поиска и передаем туда переход на контролер category в экшин search
    ?>
    <form action="<?= \yii\helpers\Url::to(['category/search'])?>" method="get">
      <input type="text" name="q" value="Поиск товара..." onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search a product...';}" required="">
      <input type="submit" value=" ">
    </form>
  </div>
  <div class="product_list_header">

    <!-- Button trigger modal       from Bootstrap 3.4 javascript-->
    <?php    // добавляем событие онклик для запуска скрипта, котрый вытащит в модальное окно данные отоварах в корзине   ?>
    <button onclick="getCart()" type="button" class="button" data-toggle="modal" data-target="#modal-cart">
      <?php //данные о сумме товара в корзине получаем из глобального массива, куда они добавились при добавлении в $_SESSION в файле класса Cart.php   ?>
      <span class="cart-qty" style="color: white !important; text-transform: none !important;">
        <?php    // //данные о количестве товара в корзине получаем из глобального массива, куда они добавились при добавлении в $_SESSION в файле класса Cart.php    ?>
        <?= $_SESSION['cart.qty'] ?? '0' ?>шт.
        <?php
//        if (isset($_SESSION['cart.qty'])){
//          echo $_SESSION['cart.qty'].' шт.';
//        }else{echo 'корзина 0$';}

        ?>
      </span>
      <span class="cart-sum" style="color: white !important; text-transform: uppercase; ">
        <?= $_SESSION['cart.sum'] ?? '0' ?> $
         <?php
//         if($_SESSION['cart.sum'])
//        echo $_SESSION['cart.sum']. '$';
         ?>
      </span>
    </button>
    <!-- Modal         from Bootstrap 3.4 javascript-->
    <div class="modal fade" id="modal-cart" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Корзина</h4>
          </div>
          <div class="modal-body">
            <?php //  сюда будет вставляться контент с товарами из корзины с помощью скрипта, после аякс запроса ?>
          </div>
          <div class="modal-footer">
            <?php
            // data-dismiss="modal" нужен для закрытия окна
            ?>
            <button type="button" class="btn btn-default" data-dismiss="modal">Продолжить покупки</button>
            <?php
            //Заказ оформляем переходом по ссылке с помощью хелпера Url в корзину
            ?>
            <a href="<?= \yii\helpers\Url::to(['cart/checkout'])?>"  class=" btn btn-success">Оформить заказ</a>
            <?php    // добавляем событие онклик для запуска скрипта, котрый очистит корзину   ?>
            <button onclick="clearCart()" type="button" class="btn btn-danger">Очистить корзину</button>
          </div>
        </div>
      </div>
    </div>
<!--    <form action="#" method="post" class="last">-->
<!--      <fieldset>-->
<!--        <input type="hidden" name="cmd" value="_cart" />-->
<!--        <input type="hidden" name="display" value="1" />-->
<!--        <input type="submit" name="submit" value="View your cart" class="button" />-->
<!--      </fieldset>-->
<!--    </form>-->

  </div>
  <div class="w3l_header_right">
    <ul>
      <li class="dropdown profile_details_drop">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user" aria-hidden="true"></i><span class="caret"></span></a>
        <div class="mega-dropdown-menu">
          <div class="w3ls_vegetables">
            <ul class="dropdown-menu drp-mnu">
              <?php
              if (Yii::$app->user->isGuest) {
              ?>
                <li><a href="<?= \yii\helpers\Url::to(['site/login'])?>">Login</a></li>
                <li><a href="<?= \yii\helpers\Url::to(['site/signup'])?>">Sign Up</a></li>
              <?php
              }else{
                ?>
                <li><a href="<?= \yii\helpers\Url::to(['home/profile'])?>">Кабинет: <br><?php
                    echo Yii::$app->user->identity->username;
                    ?></a></li>
                <li>
                  <?= Html::a("Выход", ['site/logout'], [
                      'data' => [
                        'method' => 'post'
                      ],
                      ['class' => 'white text-center']
                    ]
                  );?>
                </li>
                <?php
              }
              ?>


            </ul>
          </div>
        </div>
      </li>
    </ul>
  </div>
  <div class="w3l_header_right1">
    <h2><a href="mail.html">Contact Us</a></h2>
  </div>
  <div class="clearfix"> </div>
</div>

<div class="logo_products">
  <div class="container">
    <div class="w3ls_logo_products_left">
      <h1><a href="<?=Yii::$app->homeUrl?>"><span>Grocery</span> Store</a></h1>
    </div>
    <div class="w3ls_logo_products_left1">
      <ul class="special_items">
        <li><a href="<?= \yii\helpers\Url::to(['home/events'])?>">Events</a><i>/</i></li>
        <li><a href="<?= \yii\helpers\Url::to(['home/about'])?>">About Us</a><i>/</i></li>
        <li><a href="<?= \yii\helpers\Url::to(['home/best'])?>">Best Deals</a><i>/</i></li>
        <li><a href="<?= \yii\helpers\Url::to(['home/services'])?>">Services</a></li>
      </ul>
    </div>
    <div class="w3ls_logo_products_left1">
      <ul class="phone_email">
        <li><i class="fa fa-phone" aria-hidden="true"></i>(+0123) 234 567</li>
        <li><i class="fa fa-envelope-o" aria-hidden="true"></i><a href="mailto:store@grocery.com">store@grocery.com</a></li>
      </ul>
    </div>
    <div class="clearfix"> </div>
  </div>
</div>
<!-- //header -->





<?php
//нижепрописанный код перенесен в index.php
//<!-- подключаем левое верхнее меню, которое находится в представлении layouts/inc/sidebar.php-->
?>
<?//= $this->render('//layouts/inc/sidebar');?>




<!--  подключаем контент, то есть индексный файл views/home/index.php главной страницы-->
<?= $content;?>






<!-- newsletter -->
<div class="newsletter">
  <div class="container">
    <div class="w3agile_newsletter_left">
      <h3>sign up for our newsletter</h3>
    </div>
    <div class="w3agile_newsletter_right">
      <form action="#" method="post">
        <input type="email" name="Email" value="Email" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Email';}" required="">
        <input type="submit" value="subscribe now">
      </form>
    </div>
    <div class="clearfix"> </div>
  </div>
</div>
<!-- //newsletter -->
<!-- footer -->
<div class="footer">
  <div class="container">
    <div class="col-md-3 w3_footer_grid">
      <h3>information</h3>
      <ul class="w3_footer_grid_list">
        <li><a href="events.html">Events</a></li>
        <li><a href="about.html">About Us</a></li>
        <li><a href="products.html">Best Deals</a></li>
        <li><a href="services.html">Services</a></li>
        <li><a href="short-codes.html">Short Codes</a></li>
      </ul>
    </div>
    <div class="col-md-3 w3_footer_grid">
      <h3>policy info</h3>
      <ul class="w3_footer_grid_list">
        <li><a href="faqs.html">FAQ</a></li>
        <li><a href="privacy.html">privacy policy</a></li>
        <li><a href="privacy.html">terms of use</a></li>
      </ul>
    </div>
    <div class="col-md-3 w3_footer_grid">
      <h3>what in stores</h3>
      <ul class="w3_footer_grid_list">
        <li><a href="pet.html">Pet Food</a></li>
        <li><a href="frozen.html">Frozen Snacks</a></li>
        <li><a href="kitchen.html">Kitchen</a></li>
        <li><a href="products.html">Branded Foods</a></li>
        <li><a href="household.html">Households</a></li>
      </ul>
    </div>
    <div class="col-md-3 w3_footer_grid">
      <h3>twitter posts</h3>
      <ul class="w3_footer_grid_list1">
        <li><label class="fa fa-twitter" aria-hidden="true"></label><i>01 day ago</i><span>Non numquam <a href="#">http://sd.ds/13jklf#</a>
						eius modi tempora incidunt ut labore et
						<a href="#">http://sd.ds/1389kjklf#</a>quo nulla.</span></li>
        <li><label class="fa fa-twitter" aria-hidden="true"></label><i>02 day ago</i><span>Con numquam <a href="#">http://fd.uf/56hfg#</a>
						eius modi tempora incidunt ut labore et
						<a href="#">http://fd.uf/56hfg#</a>quo nulla.</span></li>
      </ul>
    </div>
    <div class="clearfix"> </div>
    <div class="agile_footer_grids">
      <div class="col-md-3 w3_footer_grid agile_footer_grids_w3_footer">
        <div class="w3_footer_grid_bottom">
          <h4>100% secure payments</h4>
          <img src="images/card.png" alt=" " class="img-responsive" />
        </div>
      </div>
      <div class="col-md-3 w3_footer_grid agile_footer_grids_w3_footer">
        <div class="w3_footer_grid_bottom">
          <h5>connect with us</h5>
          <ul class="agileits_social_icons">
            <li><a href="#" class="facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
            <li><a href="#" class="twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
            <li><a href="#" class="google"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
            <li><a href="#" class="instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
            <li><a href="#" class="dribbble"><i class="fa fa-dribbble" aria-hidden="true"></i></a></li>
          </ul>
        </div>
      </div>
      <div class="clearfix"> </div>
    </div>
    <div class="wthree_footer_copy">
      <p>© 2016 Grocery Store. All rights reserved | Design by <a href="http://w3layouts.com/">W3layouts</a></p>
    </div>
  </div>
</div>
<!-- //footer -->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
