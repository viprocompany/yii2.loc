<?php //значение категори её  айдишник $category['id'], название её $category['title'] ?>
<option value="<?= $category['id']; ?>"
  <?php //если айдишник текущей категории будет равен родительскому айдишнику из  свойства model, заданного в  компоненте MenuWidget, то этот опшин будет выведен в селекте?>
  <?php if($category['id'] == $this->model->category_id) echo ' selected' ?>


>
  <?= " {$tab} {$category['title']} " ?>

</option>
<!--  выводим вложеный массив с дочерними категориями-->
<?php
//для родительских категорий согласно верстке добавляем класс выпадающих списков
if (isset($category['children'])) : ?>
  <!--   если у данной категории есть поле children, выводим дочерние категории, то есть её подразделы. Задаем  значение отступ $tab, который выводим в названии категории-->
  <?= $this->getMenuHtml($category['children'], $tab . '>') ?>
<?php endif ;?>
