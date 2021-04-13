
    <!--берем разметку пунктов меню из предоставленной верстки-->
    <!-- в качечтве параметра метода catToTemplate мы передали сюда массив категорий $category , полученный в методе getMenuHtml  как параметр $tree (возвращаемого методом getTree  в виде иерархического массива) -->
    <li
      <?php
      //для родительских категорий согласно верстке добавляем класс выпадающих списков
      if (isset($category['children']))
        echo 'class="dropdown"';
      ?>
    >
      <!-- рекомендуется хелпер Url для создания адреса котрый будет показан в формате массива как пути(category/view/) к директории и номера (id) динамически подставляемой из массива  категории. всё это  работает на основе правил сформированных в urlManager-->
      <a href="<?= \yii\helpers\Url::to(['category/view/', 'id' => $category['id']]); ?>"
        <?php
        //для дочерних категорий согласно верстке добавляем класс выпадающих списков и дата-атрибут
        if (isset($category['children']))
          echo 'class="dropdown-toggle" data-toggle="dropdown"';
        ?>
      >

        <? //= debug($category); ?>

        <!--категории верхнего уровня-->
        <?= $category['title']; ?>

        <?php
        if (isset($category['children']))
        echo '<span class="caret"></span>';
        ?>

      </a>
      <!--  выводим вложеный массив с дочерними категориями-->
      <?php
      //для родительских категорий согласно верстке добавляем класс выпадающих списков
      if (isset($category['children'])) : ?>

        <div class="dropdown-menu mega-dropdown-menu w3ls_vegetables_menu">

            <div class="w3ls_vegetables">
            <ul>
              <!--   если у данной категории есть поле children, выводим дочерние категории, то есть её подразделы -->
              <?= $this->getMenuHtml($category['children']); ?>
            </ul>
            </div>

        </div>
      <?php
      endif;
      ?>
    </li>


