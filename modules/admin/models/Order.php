<?php

namespace app\modules\admin\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "orders".
 *
 * @property int $id
 * @property string $created_at
 * @property string $updated_at
 * @property int $qty
 * @property float $total
 * @property int $status
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $address
 * @property string|null $note
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'orders';
    }

    //метод для связки продуктов закза(таблица order_product ) и самих заказов ( таблица  orders)
public function getOrderProduct(){
      // у одного заказа может быть много товаров поэтому связь один ко многим. Для связи берем  из модуля модель
  // OrderProduct::class, где ее поле order_id связано с полем id в модели Order нашего модуля
  return $this->hasMany(OrderProduct::class, ['order_id' => 'id']);
}


//копируем из общего класса Order.php , который используем для клиентской части сайта поведения при формировании и  обновлении данных заказа

  public function  behaviors()
  {
    return [
      [
        //указывае класс поведения к которому прикрепляем,  привязано к константе class(в документации className, но оноустарело)
        'class' => TimestampBehavior::class,
        'attributes' => [
          //событие перед вставкой записи EVENT_BEFORE_INSERT срабатывает для полей 'created_at', 'updated_at', тo есть для атрибутов , которые относятся к модели Order. Происходит во время создания заказа заполнени этих полей в виде даты и времени согласно нижепрописанной переменной 'value'
          ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
          //событие перед обновлением записи EVENT_BEFORE_UPDATE срабатывает для 'updated_at'.Происходит во время редактирования заказа, например администратором сайта, то есть происходит обновление только одного поля updated_at
          ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
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
            [['created_at', 'updated_at', 'qty', 'name', 'email', 'phone', 'address'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['qty', 'status'], 'integer'],
            [['total'], 'number'],
            [['note'], 'string'],
            [['name', 'email', 'phone', 'address'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_at' => 'Добавлен',
            'updated_at' => 'Обновлен',
            'qty' => 'Количество',
            'total' => 'Сумма',
            'status' => 'Статус',
            'name' => 'Заказчик',
            'email' => 'Email',
            'phone' => 'Телефон',
            'address' => 'Адрес',
            'note' => 'Примечания',
        ];
    }
}
