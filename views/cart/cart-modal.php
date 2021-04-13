<?php
//если в сессии есть товары, то мы выводим их  в таблице
if(!empty($session['cart'])): ?>
  <div class="table-responsive">
    <table class="table table-hover table-striped">
      <thead>
      <tr>
        <th>Фото</th>
        <th>Наименование</th>
        <th>Кол-во</th>
        <th>Цена</th>
        <?php //иконка для удаления  позиции из корзины   ?>
        <th><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></th>
      </tr>
      </thead>
      <tbody>
      <?php //проходим циклом массив товаров в корзине , ключами делаем айдишник товара , а значением массив цена,количество, картинка,название
      foreach($session['cart'] as $id => $item):?>
        <tr>
          <?php //картинку получаем с хелпером из свойства img, которе отдает полный путь к картинке товара, потому что это свойство быыло задано в модуле админпанели в модели товаров modules/admin/models/Product.php  в методе beforeSave для созданияимени файла и пути к нему ?>
          <td><?= \yii\helpers\Html::img("@web/{$item['img']}", ['alt' => $item['title'], 'height' => 50])
            ?></td>
          <td><?= $item['title']?></td>
          <td><?= $item['qty']?></td>
          <td><?= $item['price']?></td>
          <?php //крестик для удаления товара по айди ?>
          <td><span data-id="<?= $id?>" class="glyphicon glyphicon-remove text-danger del-item" aria-hidden="true"></span></td>
        </tr>
      <?php endforeach?>
      <?php  //количество товаров  ?>
      <tr>
        <td colspan="4">Итого: </td>
        <td id="cart-qty"><?= $session['cart.qty']?> шт.</td>
      </tr>
      <?php //сумма денег  ?>
      <tr>
        <td colspan="4">На сумму: </td>
        <td id="cart-sum"><?= $session['cart.sum']?>$</td>
      </tr>
      </tbody>
    </table>
  </div>
<?php else: ?>
  <h3>Корзина пуста</h3>
<?php endif;?>
