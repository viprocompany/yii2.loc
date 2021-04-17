<?php

namespace app\modules\admin\models;

use app\models\User;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "comment".
 *
 * @property int $id
 * @property int $author_id
 * @property string $text
 * @property int|null $parent_id
 * @property int $product_id
 * @property int|null $moderate
 * @property string|null $created
 * @property int|null $is_admin
 */
class Comment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comment';
    }


  public function getUser(){
//используем связь один к многим hasMany, так как в одном товаре много  комментариев связывыаем пополю  где, id товара в таблице пользователей(модель User)  будет равен author_id в таблице коммментариев(модель Comment) . По
// этой
// связи обратясь к объекту класса Product мы получим данные объектов Comment по связи айдишника этого  товара
    return $this->hasMany(User::class, ['id' => 'author_id']);
  }

  public function getProduct(){

    return $this->hasOne(Product::class, ['id' => 'product_id']);
  }


  public function  behaviors()
  {
    return [
      [
        //указывае класс поведения к которому прикрепляем,  привязано к константе class(в документации className, но оноустарело)
        'class' => TimestampBehavior::class,
        'attributes' => [
          //событие перед вставкой записи EVENT_BEFORE_INSERT срабатывает для полей 'created',  тo есть для атрибутов которые относятся к модели Comment. Происходит во время создания заказа заполнени этих полей в виде даты и времени согласно нижепрописанной переменной 'value'
          ActiveRecord::EVENT_BEFORE_INSERT => ['created'],
        ],
        // По умолчанию происходит генерация метки времени UNIX, если вместо метки времени UNIX используется datetime, используем встроенную функцию NOW от MySql для получения текуущей даты и времени:
//        'value' => new Expression('NOW()'),
        // в письме не выводилась дата , а выводилось 'NOW()', поэтому пришлось сделать так:
        'value' => date('Y-m-d H:i:s'),
      ],
    ];
  }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['author_id', 'text', 'product_id'], 'required'],
            [['author_id', 'parent_id', 'product_id', 'moderate', 'is_admin'], 'integer'],
            [['text'], 'string'],
            [['created'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => '№ комментария',
            'author_id' => 'Автор',
            'text' => 'Комментарий',
            'parent_id' => 'Родительский комментарий №',
            'product_id' => 'Товар',
            'moderate' => 'Модерация',
            'created' => 'Создан',
            'is_admin' => 'Администратор',
        ];
    }
}
