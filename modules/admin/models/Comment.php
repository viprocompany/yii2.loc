<?php

namespace app\modules\admin\models;

use app\models\User;
use Yii;

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

    return $this->hasMany(Product::class, ['id' => 'product_id']);
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
            'id' => '№ товара',
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
