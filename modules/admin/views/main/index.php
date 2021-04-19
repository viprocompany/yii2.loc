
<?php
//задаем параметры для тайтла страницы и для хлебных крошек, виджет хлебных крошек находится на странице шаблона  админпанели modules/admin/views/layouts/admin.php
$this->title = 'Статистика магазина';
$this->params['breadcrumbs'][] = $this->title;
 ?>
<?php
//вытягиваем данные идентификации пользователя из объекта user
// debug(Yii::$app->user->identity);
?>
<?php ?>
<div class="row">
  <?php //верстку для блоков заказов, товаров и категорий берем из AdminLTE2 шаблона на странице виджетов(копируем
  //  html  через редактор)?>
  <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-aqua">
      <div class="inner">
        <?php        //данные  о количестве из объектов $orders,$products,$categories полученные из главного контроллера модуля  MianController выводим    ?>
        <h3><?= $orders ?></h3>
        <p>Заказов</p>
      </div>
      <div class="icon">
        <i class="fa fa-shopping-cart"></i>
      </div>
        <?php  //делаем ссылку на  просмотр подробных  данных о заказах,товарах и категориях в их контроллерах с помощью  хелперов ?>
      <a href="<?= \yii\helpers\Url::to(['order/index']); ?>" class="small-box-footer">
        Подробнее <i class="fa fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>
  <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-green">
      <div class="inner">
        <h3><?= $products ?></h3>
        <p>Товаров</p>
      </div>
      <div class="icon">
        <i class="fa  fa-balance-scale"></i>
      </div>
      <a href="<?= \yii\helpers\Url::to(['product/index']);?>" class="small-box-footer">
        Подробнее<i class="fa fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>
  <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-yellow">
      <div class="inner">
        <h3><?= $categories ?></h3></h3>
        <p>Категорий</p>
      </div>
      <div class="icon">
        <i class="fa fa-folder-open"></i>
      </div>
      <a href="<?= \yii\helpers\Url::to(['category/index']);?>" class="small-box-footer">
        Подробнее<i class="fa fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>
  <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-red">
      <div class="inner">
        <h3><?= $comments ?></h3></h3>
        <p>Комментариев</p>
      </div>
      <div class="icon">
        <i class="fa  fa-edit"></i>
      </div>
      <a href="<?= \yii\helpers\Url::to(['comment/index']);?>" class="small-box-footer">
        Подробнее<i class="fa fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>
  <?php        //данные  о количестве из объектов $orders,$products,$categories ,$users, $comments, полученные из  главного контроллера  модуля  MianController выводим    ?>
  <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-fuchsia">
      <div class="inner">
        <h3><?= $users ?></h3></h3>
        <p>Пользователей</p>
      </div>
      <div class="icon">
        <i class="fa  fa-users"></i>
      </div>
      <a href="<?= \yii\helpers\Url::to(['user/index']);?>" class="small-box-footer">
        Подробнее<i class="fa fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>
</div>
