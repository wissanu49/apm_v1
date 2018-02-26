<?php

namespace app\controllers;

use Yii;
use app\models\Receipt;
use app\Models\SearchReceipt;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * ReceiptController implements the CRUD actions for Receipt model.
 */
class ReceiptController extends Controller {

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'update', 'delete', 'payment'],
                'rules' => [
                    [
                        'actions' => ['index', 'update', 'delete', 'payment'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Receipt models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new SearchReceipt();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Receipt model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Receipt model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionPayment($id, $leasing) {
        $model = new Receipt();
        $room = \app\models\Leasing::find()->select('rooms_id')->where(['id' => $leasing])->one();
        $customer = \app\models\Leasing::find()->select('customers_id')->where(['id' => $leasing])->one();

        $dataCustomer = \app\models\Customers::find()->where(['id' => $customer])->all();
        $invoice = \app\models\Invoice::findAll(['id' => $id]);
        //$model->load($invoice);
        //die(print_r($invoice));
        foreach ($invoice as $data) {
            $model->invoice_id = $data['id'];
            $model->leasing_id = $data['leasing_id'];
            $model->rental = $data['rental'];
            $model->deposit = $data['deposit'];
            $model->water_price = $data['water_price'];
            $model->electric_price = $data['electric_price'];
            $model->additional_1 = $data['additional_1'];
            $model->additional_1_price = $data['additional_1_price'];
            $model->additional_2 = $data['additional_2'];
            $model->additional_2_price = $data['additional_2_price'];
            $model->additional_3 = $data['additional_3'];
            $model->additional_3_price = $data['additional_3_price'];
            $model->additional_4 = $data['additional_4'];
            $model->additional_4_price = $data['additional_4_price'];
            $model->additional_5 = $data['additional_5'];
            $model->additional_5_price = $data['additional_5_price'];
            $model->refun_1 = $data['refun_1'];
            $model->refun_1_price = $data['refun_1_price'];
            $model->refun_2 = $data['refun_2'];
            $model->refun_2_price = $data['refun_2_price'];
            $model->total = $data['total'];
            $model->comment = $data['comment'];
            $appointment =  $data['appointment'];
        }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('payment', [
                    'model' => $model,
                    'room' => $room,
                    'customer' => $dataCustomer,
                    'invoice' => $invoice,
                    'appointment' => $appointment,
        ]);
    }

    /**
     * Updates an existing Receipt model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Receipt model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Receipt model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Receipt the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Receipt::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
