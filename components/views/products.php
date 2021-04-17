<?php //значение товвара его айдишник $product['id'], название его $product['title']
?>

<?php foreach ($products as $product): ?>
  <option value="<?= $product['id']; ?>"
    <?php //если айдишник текущей категории будет равен родительскому айдишнику из  свойства model, заданного в
    //  компоненте Widget, то этот опшин будет выведен в селекте, model до сюда почему-то не доходит и выскакивает
    // ошибка ?>
    <?php
    if($product['id'] == $this->model->product_id){
      echo ' selected' ;}
    ?>
    <?php // если номер текущего товара равен номеру переданному нам в модели model, то это тот самый товар , с  которым мы работаем(по факту мы её блокируем чтоб нельзя было вызвать её из   списка ?>
    <?php //if($product['id'] == $model->product_id) echo ' disabled' ;?>

  >
    <?= "{$product['title']}" ?>

  </option>
<?php endforeach; ?>
