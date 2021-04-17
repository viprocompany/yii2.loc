<?php //значение категори её  айдишник $category['id'], название её $category['title']
use app\modules\admin\models\Product; ?>
<?php

?>
<?php foreach ($products as $product): ?>
  <option value="<?= $product['id']; ?>"
    <?php //если айдишник текущей категории будет равен родительскому айдишнику из  свойства model, заданного в  компоненте MenuWidget, то этот опшин будет выведен в селекте?>
    <?php if($product['id'] == $model->product_id) echo ' selected' ?>
  >
    <?= "{$product['title']}" ?>

  </option>
<?php endforeach; ?>
