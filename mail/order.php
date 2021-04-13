<div class="table-responsive">
  <table style="width: 100%; border: 1px solid #ddd; border-collapse: collapse;">
    <?php
    // из объекта, переданного из экшна actionCheckout получаем объект $order заказ и вытягивавем из него данные
    ?>
    <tr>
      <td colspan="3" style="padding: 8px; border: 1px solid #ddd;">Номер заказа: </td>
      <td style="padding: 8px; border: 1px solid #ddd;"><?= $order['id']?></td>
    </tr>
    <tr>
      <td colspan="3" style="padding: 8px; border: 1px solid #ddd;">Дата заказа: </td>
      <td style="padding: 8px; border: 1px solid #ddd;"><?= $order['created_at']?> </td>
    </tr>
    <tr>
      <td colspan="3" style="padding: 8px; border: 1px solid #ddd;">Телефон: </td>
      <td style="padding: 8px; border: 1px solid #ddd;"><?= $order['phone']?> </td>
    </tr>
    <tr>
      <td colspan="3" style="padding: 8px; border: 1px solid #ddd;">Email: </td>
      <td style="padding: 8px; border: 1px solid #ddd;"><?= $order['email']?> </td>
    </tr>
    <tr>
      <td colspan="3" style="padding: 8px; border: 1px solid #ddd;">Адрес доставки: </td>
      <td style="padding: 8px; border: 1px solid #ddd;"><?= $order['address']?> </td>
    </tr>
    <thead>
    <tr style="background: #f9f9f9;">
      <th style="padding: 8px; border: 1px solid #ddd;">Наименование</th>
      <th style="padding: 8px; border: 1px solid #ddd;">Кол-во</th>
      <th style="padding: 8px; border: 1px solid #ddd;">Цена</th>
      <th style="padding: 8px; border: 1px solid #ddd;">Сумма</th>
    </tr>
    </thead>
    <tbody>

    <?php
    //проходим циклом по объекту корзины и распихиваем данные о товарах в заказе, данные передаются сюда из экшна  actionCheckout CartController
    foreach($session['cart'] as $id => $item):?>

      <tr>
        <td style="padding: 8px; border: 1px solid #ddd;"><?= $item['title']?></td>
        <td style="padding: 8px; border: 1px solid #ddd;"><?= $item['qty']?></td>
        <td style="padding: 8px; border: 1px solid #ddd;"><?= $item['price']?></td>
        <td style="padding: 8px; border: 1px solid #ddd;"><?= $item['qty'] * $item['price']?></td>
      </tr>
    <?php endforeach?>
    <tr>
      <td colspan="3" style="padding: 8px; border: 1px solid #ddd;">Итого: </td>
      <td style="padding: 8px; border: 1px solid #ddd;"><?= $session['cart.qty']?> шт.</td>
    </tr>
    <tr>
      <td colspan="3" style="padding: 8px; border: 1px solid #ddd;">На сумму: </td>
      <td style="padding: 8px; border: 1px solid #ddd;"><?= $session['cart.sum']?> $</td>
    </tr>
    </tbody>
  </table>
</div>