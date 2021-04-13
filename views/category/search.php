<?php

use app\models\Category;

//debug($products);
?>
<!-- products-breadcrumb -->
<div class="products-breadcrumb">
  <div class="container">
    <ul>
      <li><i class="fa fa-home" aria-hidden="true"></i><a href="<?= Yii::$app->homeUrl ?>">Home</a><span>|</span></li>
      <li>Поиск</li>
    </ul>
  </div>
</div>
<!-- //products-breadcrumb -->
<!-- banner -->
<div class="banner">
  <?php
  //подключаем левое верхнее меню, которое находится в представлении layouts/inc/sidebar.php
  use yii\helpers\Html; ?>
  <?= $this->render('//layouts/inc/sidebar'); ?>

  <div class="w3l_banner_nav_right">
    <div class="w3l_banner_nav_right_banner3">
      <h3>Best Deals For New Products<span class="blink_me"></span></h3>
    </div>
    <div class="w3l_banner_nav_right_banner3_btm">
      <div class="col-md-4 w3l_banner_nav_right_banner3_btml">
        <div class="view view-tenth">
          <img src="images/13.jpg" alt=" " class="img-responsive"/>
          <div class="mask">
            <h4>Grocery Store</h4>
            <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt.</p>
          </div>
        </div>
        <h4>Utensils</h4>
        <ol>
          <li>sunt in culpa qui officia</li>
          <li>commodo consequat</li>
          <li>sed do eiusmod tempor incididunt</li>
        </ol>
      </div>
      <div class="col-md-4 w3l_banner_nav_right_banner3_btml">
        <div class="view view-tenth">
          <img src="images/14.jpg" alt=" " class="img-responsive"/>
          <div class="mask">
            <h4>Grocery Store</h4>
            <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt.</p>
          </div>
        </div>
        <h4>Hair Care</h4>
        <ol>
          <li>enim ipsam voluptatem officia</li>
          <li>tempora incidunt ut labore et</li>
          <li>vel eum iure reprehenderit</li>
        </ol>
      </div>
      <div class="col-md-4 w3l_banner_nav_right_banner3_btml">
        <div class="view view-tenth">
          <img src="images/15.jpg" alt=" " class="img-responsive"/>
          <div class="mask">
            <h4>Grocery Store</h4>
            <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt.</p>
          </div>
        </div>
        <h4>Cookies</h4>
        <ol>
          <li>dolorem eum fugiat voluptas</li>
          <li>ut aliquid ex ea commodi</li>
          <li>magnam aliquam quaerat</li>
        </ol>
      </div>
      <div class="clearfix"></div>
    </div>

    <div class="w3ls_w3l_banner_nav_right_grid">
      <?php
      //выводим хелпер \yii\helpers\Html::encode($q) для вывода данных поля из формы поиска
      ?>
      <h3>Поиск: <?= \yii\helpers\Html::encode($q); ?></h3>
      <?php if ((!empty($products))):
        ?>
        <div class="w3ls_w3l_banner_nav_right_grid1">
          <!--        <h6>food</h6>-->
          <?php
          foreach ($products as $product):
            ?>
            <div class="col-md-3 w3ls_w3l_banner_left">
              <div class="hover14 column">
                <div class="agile_top_brand_left_grid w3l_agile_top_brand_left_grid">
                  <?php
                  //если у продукта заполнено поле is_offer,то будет выводится маленькая картинка поверх изображения продукта
                  if ($product->is_offer):
                    ?>
                    <div class="agile_top_brand_left_grid_pos">
                      <?php ////иcпользуем хелпер HTML
                      ?>
                      <?= Html::img('@web/images/offer.png', [
                        'alt' => 'Hot offer', 'class' => 'img-responsive'
                      ])
                      ?>
                    </div>
                  <?php
                  endif;
                  ?>
                  <div class="agile_top_brand_left_grid1">
                    <figure>
                      <div class="snipcart-item block">
                        <div class="snipcart-thumb">

                          <?php // хелпер Url
                          ?>
                          <a href="<?= \yii\helpers\Url::to(['product/view', 'id' => $product->id]) ?>">
                            <?php //картинку получаем с хелпером из свойства img, которе отдает полный путь к картинке товара, потому что это свойство быыло задано в модуле админпанели в модели товаров modules/admin/models/Product.php  в методе beforeSave для созданияимени файла и пути к нему ?>
                            <?= Html::img("@web/{$product->img}", [
                              'alt' => "$product->title"])
                            ?>
                          </a>
                          <p><?= $product->title; ?></p>
                          <h4>$<?= $product->price; ?>
                            <?php
                            if ((float)$product->old_price):
                              ?>
                              <span>$<?= $product->old_price; ?></span>
                            <?php
                            endif;
                            ?>
                          </h4>
                        </div>

                        <div class="snipcart-details">
                          <?php // переход по ссылке в корзину с помощью хелпера, переход осуществляется в экшн контроллера по айдишнику горячего предложения. Параметр  в теге для аякс запроса: айдишник товара ,кроме класса button из вёрстки  добавляем наш класс   add-to-cart для работы со скриптом аякс
                          ?>
                          <a href="<?= \yii\helpers\Url::to(['cart/add', 'id' => $product->id]) ?>"
                             class="button add-to-cart" data-id="<?= $product->id; ?>">В корзину</a>
                        </div>
                      </div>
                    </figure>
                  </div>
                </div>
              </div>
            </div>
          <?php
          endforeach;
          ?>
          <div class="clearfix"></div>
          <!--        пагинация-->
          <div class="col-md-12">
            <!--          выводим виджет для пагинации с параметром pagination и его значением $pages, переданным из контролерра CategoryController-->
            <?= \yii\widgets\LinkPager::widget(['pagination' => $pages,
              //берем свойство nextPageCssClass для офомления стиля вывода стрелок навигации, по умолчанию next
              'nextPageCssClass' => 'next',
              //количество кнопок-страниц, по умолчанию 10
              'maxButtonCount' => 4,
            ]); ?>
          </div>
        </div>
      <?php
      else:
        ?>
        <div class="w3ls_w3l_banner_nav_right_grid1">
          <h6>Здесь пока нет товаров</h6>
        </div>
      <?php
      endif;
      ?>
    </div>
  </div>

  <div class="clearfix"></div>
</div>
<!-- //banner -->
