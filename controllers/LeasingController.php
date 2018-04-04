<?php

namespace app\controllers;

use Yii;
use app\models\Leasing;
use app\Models\SearchLeasing;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\Invoice;

/**
 * LeasingController implements the CRUD actions for Leasing model.
 */
class LeasingController extends Controller {

    /**
     * {@inheritdoc}
     */
    public $KEY_RUN = 'LE';
    public $FIELD_NAME = 'id';
    public $TABLE_NAME = 'leasing';
    public $IN_KEY_RUN = 'IN';
    public $IN_FIELD_NAME = 'id';
    public $IN_TABLE_NAME = 'invoice';
    public $Month, $Year, $CODE, $LastID, $Key, $last_id = "";  // เก็บค่าเดือน เช่น 04  date("m")
    public $last_3_digit, $new_3_digit;

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'update', 'delete', 'create', 'checkin', 'checkout'],
                'rules' => [
                    [
                        'actions' => ['index', 'update', 'delete', 'create', 'checkin', 'checkout'],
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
     * Lists all Leasing models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new SearchLeasing();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Leasing model.
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
     * Creates a new Leasing model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Leasing();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    public function actionCheckin($room) {
        $model = new Leasing();
        $model->scenario = 'checkin';
        $model->id = self::RunningCodes($this->FIELD_NAME, $this->TABLE_NAME, $this->KEY_RUN);
        $model->rooms_id = $room;

        $config = \app\models\Company::find()->all();



        if ($model->load(Yii::$app->request->post())) {
            $transection = Yii::$app->db->beginTransaction();
            $model->leasing_date = date('Y-m-d H:i:s');
            $model->users_id = Yii::$app->user->identity->id;
            $model->id = self::RunningCodes($this->FIELD_NAME, $this->TABLE_NAME, $this->KEY_RUN);
            $roomsModel = \app\models\Rooms::findOne($model->rooms_id);

            try {
                if ($model->save()) {
                    Yii::$app->session->setFlash('success', 'บันทึกข้อมูลสำเร็จ');

                    $roomsModel->status = 'ไม่ว่าง';
                    if ($roomsModel->update()) {
                        $transection->commit();
                        return $this->redirect(['invoice/deposit', 'leasing' => $model->id]);
                    }
                } else {
                    Yii::$app->session->setFlash('error', 'เกิดข้อผิดพลาด. กรุณาลองใหม่อีกครั้ง');
                    $transection->rollBack();
                    return $this->redirect(['rooms/index']);
                }
            } catch (Exception $ex) {
                Yii::$app->session->setFlash('error', 'เกิดข้อผิดพลาด.' . $ex);
                //return $this->redirect(['create']);
            }
        }

        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    public function actionCheckout($room) {

        $leasing = Leasing::find()->select('id')->where(['rooms_id' => $room, 'status' => 'IN'])->one();
        $model = $this->findModel($leasing->id);

        $invoice = new Invoice();
        $invoice->scenario = 'create';

        $leasing = Leasing::find()->select('id')->where(['rooms_id' => $room, 'status' => 'IN'])->one();
        $customer = Leasing::find()->select('customers_id')->where(['id' => $leasing->id])->one();

        $dataCustomer = \app\models\Customers::find()->where(['id' => $customer->customers_id])->all();
        $rental = \app\models\Rooms::getPrice($room);
        $deposit = \app\models\Rooms::getDeposit($room);
        $invoice->id = self::RunningCodes($this->IN_FIELD_NAME, $this->IN_TABLE_NAME, $this->IN_KEY_RUN);
        $invoice->leasing_id = $leasing->id;
        $invoice->rental = $rental;

        $owe = Invoice::find()->where(['leasing_id' => $leasing->id, 'status' => 'รอการชำระ'])->all();

        $config = \app\models\Company::find()->all();

        if ($model->load(Yii::$app->request->post())) {
            $transection = Yii::$app->db->beginTransaction();
            $roomsModel = \app\models\Rooms::findOne($model->rooms_id);
            try {
                if ($model->save()) {
                    Yii::$app->session->setFlash('success', 'บันทึกข้อมูลสำเร็จ');

                    $roomsModel->status = 'ว่าง';
                    if ($roomsModel->update()) {
                        $transection->commit();
                        //return $this->redirect(['invoice/checkout', 'room' => $model->rooms_id, 'leasing' => $model->id]);
                        return $this->redirect(['invoice/index']);
                    }
                } else {
                    Yii::$app->session->setFlash('error', 'เกิดข้อผิดพลาด. กรุณาลองใหม่อีกครั้ง');
                    $transection->rollBack();
                    return $this->redirect(['rooms/index']);
                }
            } catch (Exception $ex) {
                Yii::$app->session->setFlash('error', 'เกิดข้อผิดพลาด.' . $ex);
                //return $this->redirect(['create']);
            }
        }

        return $this->render('_checkout', [
                    'model' => $model,
                    'room' => $room,
                    'invoice' => $invoice,
                    'customer' => $dataCustomer,
                    'config' => $config,
                    'owe' => $owe, // ยอดค้างชำระ
                    'deposit' => $deposit, // ค่าประกันห้อง
        ]);
    }

    /**
     * Updates an existing Leasing model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {

        $model = $this->findModel($id);


        if ($model->load(Yii::$app->request->post())) {

            $transection = Yii::$app->db->beginTransaction();
            $roomsModel = \app\models\Rooms::findOne($model->rooms_id);

            try {
                if ($model->save()) {
                    if ($model->status == 'CANCEL') {
                        $roomsModel->status = 'ว่าง';
                        if ($roomsModel->update()) {
                            Yii::$app->session->setFlash('success', 'บันทึกข้อมูลสำเร็จ');
                            $transection->commit();
                            return $this->redirect(['index']);
                        }
                    }
                    Yii::$app->session->setFlash('success', 'บันทึกข้อมูลสำเร็จ');
                            $transection->commit();
                            return $this->redirect(['index']);
                    
                } else {
                    Yii::$app->session->setFlash('error', 'เกิดข้อผิดพลาด. กรุณาลองใหม่อีกครั้ง');
                    $transection->rollBack();
                    return $this->redirect(['index']);
                }
            } catch (Exception $ex) {
                Yii::$app->session->setFlash('error', 'เกิดข้อผิดพลาด. กรุณาลองใหม่อีกครั้ง');
                //return $this->redirect(['create']);
            }
        }

        return $this->renderAjax('_form', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Leasing model.
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
     * Finds the Leasing model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Leasing the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Leasing::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function RunningCodes($field, $table, $key) {

        $this->Month = date("m");
        $this->Year = substr((date("Y")), 2);

        $this->CODE = $key . $this->Year . $this->Month;
        $run = $this->findCode($field, $table, $this->CODE);

        if (isset($run['id'])) {

            $this->last_id = $run['id'];
            //echo $last_id."<br>";
            $this->last_3_digit = substr($this->last_id, -3, 3); // ตัดเอาเฉพาะ 4 หลักสุดท้าย
            //echo $last_4_digit."<br>";

            $this->last_3_digit = $this->last_3_digit + 1;
            //echo $last_4_digit."<br>";
            while (strlen($this->last_3_digit) < 3) {
                $this->last_3_digit = "0" . $this->last_3_digit;
            }
            $this->CODE = $this->CODE . $this->last_3_digit;
            return $this->CODE;
            //$ObjQry=mysql_query("INSERT INTO create_id(row,id) VALUES('','$CODE')");
        } else {
            $this->CODE = $this->CODE . "001";
            return $this->CODE;
        }
    }

    public function findCode($field, $table, $code) {
        $sql = "SELECT MAX($field) as id FROM $table WHERE $field LIKE '$code%'";

        //$command = Yii::$app()->createCommand($sql);
        $row = Yii::$app->db->createCommand($sql)->queryOne();
        return $row;
    }

}
