<?php

namespace app\modules\admin\controllers;

use app\modules\admin\models\OrderProduct;
use Yii;
use app\modules\admin\models\Order;
use yii\data\ActiveDataProvider;
use app\modules\admin\controllers\AppAdminController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OrderController implements the CRUD actions for Order model.
 */
class OrderController extends AppAdminController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Order models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Order::find(),
          //прописываем пагинацию для страницы, по 5 записи
          'pagination' => ['pageSize' => 10],
          //задаем сортировку вывода записей на страницу, используем  параметр sort выбираем вывод по умолчанию для  id  с встроенной константой SORT_DESC
          'sort' => ['defaultOrder' => ['id' => SORT_DESC]],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Order model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    //для страницы детального посмотра заказа
    public function actionView($id)
    {
        return $this->render('view', [
          //получаем объект модели по айдишнику  заказа и передаем ее в представление view
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Order model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Order();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Order model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
          //если данные успешно сохранились то запишем в сессию флеш-сообщение об успешном выполнении
          Yii::$app->session->setFlash('success' , 'Заказ изменён успешно!');
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Order model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
      //удаление по связи таблиц orderProduct ,, где его прописали
//        $this->findModel($id)->unlink('orderProduct', true);
        $this->findModel($id)->delete();
        //удаление всех продуктов в таблице order_product по их полю order_id, котрое является номером заказа и  соответсвует номеру заказа в таблице orders и передается в этот экшн как $id
        OrderProduct::deleteAll(['order_id' => $id]);
      //если данные успешно удалены то запишем в сессиюфлеш-сообщение об успешном выполнении
      Yii::$app->session->setFlash('success' , 'Заказ удалён успешно!');
        return $this->redirect(['index']);
    }

    /**
     * Finds the Order model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Order the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Order::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
