<?php

namespace app\modules\admin\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property int $category_id
 * @property string $title
 * @property string $content
 * @property float $price
 * @property float $old_price
 * @property string|null $description
 * @property string|null $keywords
 * @property string $img
 * @property int $is_offer
 */
class Product extends \yii\db\ActiveRecord
{
  //объект файла записан как свойство файл для использования в решении для загрузки картинок с гитхаба https://github
  //.com/kartik-v/yii2-widget-fileinput
  public $file;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }


    //связываем продукт  с категорией в котрой он находится , связь один к одному. id из Category соответствует  category_id классу модели Product где расположен метод
  public function getCategory(){
      return $this->hasOne(Category::class, ['id' => 'category_id']);
  }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'title', 'content'], 'required'],
            [['category_id', 'is_offer'], 'integer'],
            [['content'], 'string'],
            [['price', 'old_price'], 'number'],
          //значения по умолчанию для этого поля 0
            [['price'], 'default', 'value' => 0],
          //если картинка не выбрана будет подключаться заглушка
            [['img'], 'default', 'value' => "products/no-image.png"],
          //img это имя файла картинки
            [['title', 'description', 'keywords', 'img'], 'string', 'max' => 255],
          //для объекта файл устанавливаем  валидацию как для картинки
          [['file'] , 'image']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Категория',
            'title' => 'Назвние продукта',
            'content' => 'Содержание',
            'price' => 'Цена',
            'old_price' => 'Старая цена',
            'description' => 'Описание',
            'keywords' => 'Ключевые слова',
            'img' => 'Изображение',
            'file' => 'Фото',
            'is_offer' => 'Горячее предложение',
        ];
    }

    //сохраняем файл в нужнье место(парметр img)  и снужным именем применив поведение(перехватим событие) "перед  сохранением"   beforeSave
    public function beforeSave($insert){
      // объект $file класса UploadedFile получив файл по имени методом getInstance с информацией о загруженном файле: name,  tempName,   type,  size,error,_tempResource
      //первым параметром передаем модель, здесь это текущая модель $this
      //второй парметр атрубута file, так как именно его мы указали в решении с гитхаба https://github.com/kartik-v/yii2-widget-fileinput в представлении полей формы _form.php
      if ($file = UploadedFile::getInstance($this, 'file')) {
//        debug($file);
//        die;
        //создаем имя папки по сегодняшней дате, если такая есть, то используем её, если нет то создадим
        $dir = 'products/' . date("Y-m-d") . '/';
        if(!is_dir($dir)){
          mkdir($dir);
        }
//генерация уникального имени файла функцией uniqid, загружаемое имя файла $file->baseName, расширение файла $file->extension
        $file_name = uniqid() . '_' . $file->baseName . '.' . $file->extension;
        //записываем путь к файлу в свойстово img, применив папка($dir)/имя($file_name) для записи в таблицу products
        $this->img = $dir . $file_name;
        //сохраняем файл как имя с путём, куда он сохранится
        $file->saveAs($this->img);

      }


//возвращаем результат выполнения родительского  метода
      return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }

}
