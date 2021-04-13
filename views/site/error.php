<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<!-- banner -->
<div class="banner">
  <?php
  //подключаем левое верхнее меню, которое находится в представлении layouts/inc/sidebar.php
  ?>
  <?= $this->render('//layouts/inc/sidebar');?>
  <div class="site-error">
  <div class="w3l_banner_nav_right">

    <h2><?= Html::encode($this->title) ?></h2>

    <div class="alert alert-danger" style="margin:  10px;">
      <?= nl2br(Html::encode($message)) ?>
    </div>
  </div>
  <div class="clearfix"></div>
</div>
<!-- banner -->






</div>
