 <?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Category */

$this->title = 'Категория: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Категории', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

 <div class="col-md-12">
   <div class="box">
     <div class="box-header with-border">
       <?php //кнопку подняли сюда из-за пределов блока, так как  она была автоматически сгененрирована в этом файле   при  помощи Gii, поменяли её на писание на "... Категорию" ?>
       <p>
         <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
         <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
           'class' => 'btn btn-danger',
           'data' => [
             'confirm' => 'Вы уверены, что хотите удалить эту категорию ?',
             'method' => 'post',
           ],
         ]) ?>
       </p>
     </div>
     <div class="box-body">
       <div class="category-view">
         <?= DetailView::widget([
           'model' => $model,
           'attributes' => [
             'id',
//             'parent_id',
 //если значение не нулевое вытаскиваем название категории из объекта $model,  если нет , то выведем 'Самостоятельная категория'
             ['attribute' => 'parent_id',
               'value' => isset($model->category->title) ?
                 '<a href="' . \yii\helpers\Url::to(['category/view', 'id' => $model->category->id]) . '">' .
                 $model->category->title . '</a>' :
                 'Нет, это верхний уровень',
               'format' => 'raw',
             ],
             'title',
             'description',
             'keywords',
           ],
         ]) ?>
       </div>
     </div>
   </div>

