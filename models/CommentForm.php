<?php


namespace app\models;


use Yii;
use yii\base\Model;
use yii\helpers\ArrayHelper;

class CommentForm extends Model
{
//сделал класс модели формы для добавления в ней комментариев ктоварам на детальной странице товара
public $id;
public $author_id;
public $text;
public $parent_id;
public $product_id;
public $moderate;
public $created;
public $is_admin;


public  $comment;


  public function rules()
  {
    return [
      // name, email, subject and body are required
      [['text'], 'required'],
      // email has to be a valid email address
      [['text'],'string', 'length' => [3,5000]],
      [['author_id', 'parent_id', 'product_id','is_admin', 'moderate'], 'integer'],

    ];
  }
  public function attributeLabels()
  {
    return [
      'parent_id' => 'К отзыву',
      'text' => 'Текст',
    ];
  }

  public function saveComment($product_id)
  {
    $comment = new Comment();

//    debug(ArrayHelper::toArray($this));
//    die;
  $comment->moderate = $this->moderate;
  $comment->is_admin = $this->is_admin;
    $comment->parent_id = $this->parent_id;
    $comment->product_id = $product_id;
//    $comment->product_id = $this->product_id;
    $comment->text = $this->text;
    $comment->author_id = Yii::$app->user->id;
//    debug(ArrayHelper::toArray($comment));
//    die;



    return $comment->save();
  }
}