<?php

namespace app\controllers;

use Yii;
use app\models\Invoice;
use app\Models\SearchInvoice;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * InvoiceController implements the CRUD actions for Invoice model.
 */
class InvoiceController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'update', 'delete', 'deposit', 'invoice'],
                'rules' => [
                    [
                        'actions' => ['index', 'update', 'delete', 'deposit', 'invoice'],
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
     * Lists all Invoice models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SearchInvoice();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Invoice model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
    
     public function actionInvoice()
    {
        return $this->render('invoice');
    }

    /**
     * Creates a new Invoice model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionDeposit($leasing)
    {
        $model = new Invoice();
        //$modelLeasing = \app\models\Leasing::find()->where(['id'=>$leasing])->all();
        //$modelLeasing = $leas::findAll(['id'=>$leasing]);
        //die(print_r($modelLeasing));
        $model->leasing_id = $leasing;
        
        if ($model->load(Yii::$app->request->post())) {
             try {
                if ($model->save()) {
                    Yii::$app->session->setFlash('success', 'บันทึกข้อมูลสำเร็จ');
                    $transection->commit();
                    return $this->redirect(['viewdeposit', 'id' => $model->id]);
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

        return $this->render('deposit', [
            'model' => $model,
        ]);
    }
    
   

    /**
     * Updates an existing Invoice model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Invoice model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Invoice model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Invoice the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Invoice::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
