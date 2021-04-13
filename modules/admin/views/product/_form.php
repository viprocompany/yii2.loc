<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
use kartik\file\FileInput;

mihaildev\elfinder\Assets::noConflict($this);
/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php //echo $form->field($model, 'category_id')->textInput() ?>

  <div class="category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <div class="form-group field-product-category_id has-success">
      <label class="control-label" for="product-category_id">Kатегория</label>
      <select id="product-category_id" class="form-control" name="Product[category_id]">

        <?= \app\components\MenuWidget::widget([
          'tpl' => 'select_product',
          'model' => $model,
          'cache_time' => 0,

        ]);?>
      </select>

      <div><div class="help-block"></div></div>

    </div>

    <?//= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?php
    // CKEditor и elfinder установлены с помощью композера гитхаба https://github.com/MihailDev/yii2-ckeditor
    //без загрузки картинок на сервер и выбора с сервера

//    echo $form->field($model, 'content')->widget(CKEditor::class,[
    ////      'editorOptions' => [
    ////        'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
    ////        'inline' => false, //по умолчанию false
    ////      ],
    ////    ]);

    //взято с Гитхаба https://github.com/MihailDev/yii2-elfinder для загрузки картинок визуального редактора CKeditor
    // с сеервера папка upload
//возможность выбирать изображение из директории проекта из upload/files. Конфигурация использования прописана в    файле config/web.php для 'controllerMap' => [ 'elfinder' =>
echo  $form->field($model, 'content')->widget(CKEditor::class, [

  'editorOptions' => ElFinder::ckeditorOptions(['elfinder', 'path' => 'some/sub/path'],[/* Some CKEditor Options */]),

]);
    ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'old_price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>

    <?//= $form->field($model, 'img')->textInput(['maxlength' => true]) ?>
    <?php
    //расширение для загрузки картинок с гитхаба https://github.com/kartik-v/yii2-widget-fileinput
    ?>
    <?php
    echo $form->field($model, 'file')->widget(FileInput::class, [
      'options' => ['accept' => 'image/*'],
      //из документации к демо на странице гитхаба берем плагин pluginOptions для оформления внешнего вида, что не
      // обязательно
      'pluginOptions' => [
        'showCaption' => false,
        'showRemove' => true,
        'showUpload' => false,
//        'browseClass' => 'btn btn-primary btn-block',
//        'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
//        'browseLabel' =>  'Select Photo'
      ],
    ]);
    ?>

  <?php
  //для горячего предложения  можно сделать выпадающий список, а учитывая, что у нас только два значения можно просто их
  //  перечислить без массива ключ/значение
  ?>
  <?= $form->field($model, 'is_offer')->dropDownList(['Нет', 'ДА']) ?>
    <?php // echo $form->field($model, 'is_offer')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
