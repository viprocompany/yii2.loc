<?php
namespace app\components;


use app\modules\admin\models\Product;
use Yii;
use yii\base\Widget;

/**
 * Виджет для вывода списка брендов каталога
 */
class ProductWidget extends Widget {
//  //свойство темплэйта для меню в зависимости от шаблона, куда оно подключено
  public $tpl;
//время кеширования в секундах default=60
  public $cache_time = 60;
  //
  public $html;
  // проверять активность категории, в $model будет находится текущая категория. Если в адресной сторке айдишник
  //   категории равен айдишнику категории в выпадающем списке , то она становится неактивной/ также будет
  //   сравниваться значение parent_id текущей категории и тем, которое есть в $model и к\если они будут совпадать,  то  есть она будет выбранной , селект будет подсвечиваться ПОЧЕМУ_ТО НЕ ДОХОДИТ ДО АДРЕСАТА С ОШИБКОЙ ЧТО,  ТАКОГО СВОЙСТВА НЕТ
  public $model;

  public function init()
  {
    parent::init();

    if ($this->tpl === null){
      $this->tpl = 'products';
    }
    //так как мы можем получать название шаблона из настроек как именованный вид без расширения , то после прохождения проверки к нему будет добавляться расширение php . первоначально тоже будет создаваться название темплейта прибавлением php к menu : menu.php
    $this->tpl .= '.php';
  }

  public function run(){
    //get cache получаем данные из кеша если они есть, при условии, что задано значение свойства  о времени кеширования $cache_time, если значение 0, то значит кеш не будет использован меню оттуда не берем, все значения будут взяты из БД
    if ($this->cache_time){
    // пробуем извлечь данные из кеша
    $html = Yii::$app->cache->get('products');
      if ($html){
        return $html;
      }
      if ($html === false){
        // данных нет в кеше, получаем их заново
        $products = Product::find()->asArray()->all();
        $html = $this->render('products', ['products' => $products]);
        // сохраняем полученные данные в кеше
        Yii::$app->cache->set('products', $html );
        return $html;
      }
    }
    // данных нет в кеше, получаем их заново
    $products = Product::find()->asArray()->all();
    $html = $this->render('products', ['products' => $products]);
    return $html;

    //временно удалял кэш
//    Yii::$app->cache->flush();

  }

}