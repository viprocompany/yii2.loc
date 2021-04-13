<!-- banner -->
<div class="banner">
  <?php
  //подключаем левое верхнее меню, которое находится в представлении layouts/inc/sidebar.php
  ?>
  <?= $this->render('//layouts/inc/sidebar'); ?>

  <div class="w3l_banner_nav_right">
    <section class="slider">
      <div class="flexslider">
        <ul class="slides">
          <li>
            <div class="w3l_banner_nav_right_banner">
              <h3>Make your <span>food</span> with Spicy.</h3>
              <div class="more">
                <a href="products.html" class="button--saqui button--round-l button--text-thick" data-text="Shop now">Shop
                  now</a>
              </div>
            </div>
          </li>
          <li>
            <div class="w3l_banner_nav_right_banner1">
              <h3>Make your <span>food</span> with Spicy.</h3>
              <div class="more">
                <a href="products.html" class="button--saqui button--round-l button--text-thick" data-text="Shop now">Shop
                  now</a>
              </div>
            </div>
          </li>
          <li>
            <div class="w3l_banner_nav_right_banner2">
              <h3>upto <i>50%</i> off.</h3>
              <div class="more">
                <a href="products.html" class="button--saqui button--round-l button--text-thick" data-text="Shop now">Shop
                  now</a>
              </div>
            </div>
          </li>
        </ul>
      </div>
    </section>

  </div>
  <div class="clearfix"></div>
</div>
<!-- banner -->
<div class="banner_bottom">
  <div class="wthree_banner_bottom_left_grid_sub">
  </div>
  <div class="wthree_banner_bottom_left_grid_sub1">
    <div class="col-md-4 wthree_banner_bottom_left">
      <div class="wthree_banner_bottom_left_grid">
        <img src="images/4.jpg" alt=" " class="img-responsive"/>
        <div class="wthree_banner_bottom_left_grid_pos">
          <h4>Discount Offer <span>25%</span></h4>
        </div>
      </div>
    </div>
    <div class="col-md-4 wthree_banner_bottom_left">
      <div class="wthree_banner_bottom_left_grid">
        <img src="images/5.jpg" alt=" " class="img-responsive"/>
        <div class="wthree_banner_btm_pos">
          <h3>introducing <span>best store</span> for <i>groceries</i></h3>
        </div>
      </div>
    </div>
    <div class="col-md-4 wthree_banner_bottom_left">
      <div class="wthree_banner_bottom_left_grid">
        <img src="images/6.jpg" alt=" " class="img-responsive"/>
        <div class="wthree_banner_btm_pos1">
          <h3>Save <span>Upto</span> $10</h3>
        </div>
      </div>
    </div>
    <div class="clearfix"></div>
  </div>
  <div class="clearfix"></div>
</div>
<!-- top-brands -->
<?php

use yii\helpers\Html;

if ((!empty($offers))):
  ?>
  <div class="top-brands">
    <div class="container">
      <h3>Hot Offers</h3>
      <div class="agile_top_brands_grids">
        <?php
        foreach ($offers as $offer):
          ?>
          <div class="col-md-3 top_brand_left">
            <div class="hover14 column">
              <div class="agile_top_brand_left_grid">
                <div class="agile_top_brand_left_grid_pos">
                  <?php ////иcпользуем хелпер HTML
                  ?>
                  <?= Html::img('@web/images/offer.png', [
                    'alt' => 'Hot offer', 'class' => 'img-responsive'
                  ]) ?>
                  <?php //<img src="images/offer.png" alt=" " class="img-responsive" />
                  ?>
                </div>
                <?php //данная рекламная картинка применялась только на одном изображении, поэтому коммент
                //<!--<div class="tag"><img src="images/tag.png" alt=" " class="img-responsive" /></div>-->
                ?>
                <div class="agile_top_brand_left_grid1">
                  <figure>
                    <div class="snipcart-item block">
                      <div class="snipcart-thumb">
                        <?php // хелпер Url
                        ?>
                        <a href="<?= \yii\helpers\Url::to(['product/view', 'id' => $offer->id]) ?>">
                          <?php //картинку получаем с хелпером из свойства img, которе отдает полный путь к картинке товара, потому что это свойство быыло задано в модуле админпанели в модели товаров modules/admin/models/Product.php  в методе beforeSave для созданияимени файла и пути к нему
                          ?>
                          <?= Html::img("@web/{$offer->img}", [
                            'alt' => "$offer->title"])
                          ?>
                          <?php //<img title=" " alt=" " src="images/1.png" />
                          ?>
                        </a>
                        <?php // название из объекта
                        ?>
                        <p><?= $offer->title; ?></p>
                        <h4>
                          <?php // цену берем из объекта
                          ?>
                          <?= $offer->price; ?>
                          <?php //старую цену берем из объекта
                          ?>
                          <?php
                          //                      if ($offer->old_price != 0.00):
                          if ((float)$offer->old_price):
                            ?>
                            <span><?= $offer->old_price; ?></span>
                          <?php
                          endif;
                          ?>
                        </h4>
                      </div>
                      <div class="snipcart-details top_brand_home_details">
                        <?php // переход по ссылке в корзину с помощью хелпера, переход осуществляется в экшн контроллера по айдишнику горячего предложения. Параметр  в теге для аякс запроса: айдишник товара ,кроме класса button из вёрстки  добавляем наш класс   add-to-cart для работы со скриптом аякс
                        ?>
                        <a href="<?= \yii\helpers\Url::to(['cart/add', 'id' => $offer->id]) ?>"
                           class="button add-to-cart" data-id="<?= $offer->id; ?>">В корзину</a>

                        <!--                    -->
                        <!--                    <form action="checkout.html" method="post">-->
                        <!--                      <fieldset>-->
                        <!--                        <input type="hidden" name="cmd" value="_cart" />-->
                        <!--                        <input type="hidden" name="add" value="1" />-->
                        <!--                        <input type="hidden" name="business" value=" " />-->
                        <!--                        <input type="hidden" name="item_name" value="Fortune Sunflower Oil" />-->
                        <!--                        <input type="hidden" name="amount" value="7.99" />-->
                        <!--                        <input type="hidden" name="discount_amount" value="1.00" />-->
                        <!--                        <input type="hidden" name="currency_code" value="USD" />-->
                        <!--                        <input type="hidden" name="return" value=" " />-->
                        <!--                        <input type="hidden" name="cancel_return" value=" " />-->
                        <!---->
                        <!--<input type="submit" name="submit" value="Add to cart" class="button" />-->
                        <!--                      </fieldset>-->
                        <!---->
                        <!--                    </form>-->

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
      </div>
    </div>
  </div>
<?php
endif;
?>
<!-- //top-brands -->

<!-- fresh-vegetables -->
<div class="fresh-vegetables">
  <div class="container">
    <h3>Top Products</h3>
    <div class="w3l_fresh_vegetables_grids">
      <div class="col-md-3 w3l_fresh_vegetables_grid w3l_fresh_vegetables_grid_left">
        <div class="w3l_fresh_vegetables_grid2">
          <ul>
            <li><i class="fa fa-check" aria-hidden="true"></i><a href="products.html">All Brands</a></li>
            <li><i class="fa fa-check" aria-hidden="true"></i><a href="vegetables.html">Vegetables</a></li>
            <li><i class="fa fa-check" aria-hidden="true"></i><a href="vegetables.html">Fruits</a></li>
            <li><i class="fa fa-check" aria-hidden="true"></i><a href="drinks.html">Juices</a></li>
            <li><i class="fa fa-check" aria-hidden="true"></i><a href="pet.html">Pet Food</a></li>
            <li><i class="fa fa-check" aria-hidden="true"></i><a href="bread.html">Bread & Bakery</a></li>
            <li><i class="fa fa-check" aria-hidden="true"></i><a href="household.html">Cleaning</a></li>
            <li><i class="fa fa-check" aria-hidden="true"></i><a href="products.html">Spices</a></li>
            <li><i class="fa fa-check" aria-hidden="true"></i><a href="products.html">Dry Fruits</a></li>
            <li><i class="fa fa-check" aria-hidden="true"></i><a href="products.html">Dairy Products</a></li>
          </ul>
        </div>
      </div>
      <div class="col-md-9 w3l_fresh_vegetables_grid_right">
        <div class="col-md-4 w3l_fresh_vegetables_grid">
          <div class="w3l_fresh_vegetables_grid1">
            <img src="images/8.jpg" alt=" " class="img-responsive"/>
          </div>
        </div>
        <div class="col-md-4 w3l_fresh_vegetables_grid">
          <div class="w3l_fresh_vegetables_grid1">
            <div class="w3l_fresh_vegetables_grid1_rel">
              <img src="images/7.jpg" alt=" " class="img-responsive"/>
              <div class="w3l_fresh_vegetables_grid1_rel_pos">
                <div class="more m1">
                  <a href="products.html" class="button--saqui button--round-l button--text-thick" data-text="Shop now">Shop
                    now</a>
                </div>
              </div>
            </div>
          </div>
          <div class="w3l_fresh_vegetables_grid1_bottom">
            <img src="images/10.jpg" alt=" " class="img-responsive"/>
            <div class="w3l_fresh_vegetables_grid1_bottom_pos">
              <h5>Special Offers</h5>
            </div>
          </div>
        </div>
        <div class="col-md-4 w3l_fresh_vegetables_grid">
          <div class="w3l_fresh_vegetables_grid1">
            <img src="images/9.jpg" alt=" " class="img-responsive"/>
          </div>
          <div class="w3l_fresh_vegetables_grid1_bottom">
            <img src="images/11.jpg" alt=" " class="img-responsive"/>
          </div>
        </div>
        <div class="clearfix"></div>
        <div class="agileinfo_move_text">
          <div class="agileinfo_marquee">
            <h4>get <span class="blink_me">25% off</span> on first order and also get gift voucher</h4>
          </div>
          <div class="agileinfo_breaking_news">
            <span> </span>
          </div>
          <div class="clearfix"></div>
        </div>
      </div>
      <div class="clearfix"></div>
    </div>
  </div>
</div>
<!-- //fresh-vegetables -->