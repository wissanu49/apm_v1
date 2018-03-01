<?php

namespace app\controllers;

use Yii;
use app\models\Energies;
use app\models\EnergiesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * EnergiesController implements the CRUD actions for Energies model.
 */
class EnergiesController extends Controller {

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'update', 'delete', 'add', 'histories'],
                'rules' => [
                    [
                        'actions' => ['index', 'update', 'delete', 'add', 'histories'],
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
     * Lists all Energies models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new EnergiesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Energies model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Energies model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionAdd($room) {
        $model = new Energies();
        $model->scenario = 'add_data';
        $model->rooms_id = $room;
        $model->users_id = Yii::$app->user->identity->id;
        if ($model->load(Yii::$app->request->post())) {
            $transection = \Yii::$app->db->beginTransaction();
            try {
                //$model->users_id = Yii::$app->user->identity->id;
                $model->record_date = date('Y-m-d H:i:s');
                //die(var_dump($model));
                if ($model->save()) {
                    Yii::$app->session->setFlash('success', 'บันทึกข้อมูลสำเร็จ');
                    $transection->commit();
                    return $this->redirect(['histories', 'room' => $model->rooms_id]);
                }
            } catch (Exception $ex) {
                Yii::$app->session->setFlash('error', $ex);
            }
        }

        return $this->renderAjax('create', [
                    'model' => $model,
        ]);
    }

    public function actionHistories($room) {
        
        $dataProvider = Energies::find()->where(['rooms_id' => $room])->orderBy('id DESC')->all();
        $rooms = \app\models\Rooms::find()->select('name')->where(['id' => $room])->one();
        //die(print_r($dataProvider));
        return $this->render('histories', [
                    'dataProvider' => $dataProvider,
            'roomname' => $rooms->name,
        ]);
        
         //return $this->renderAjax('histories');
    }

    /**
     * Updates an existing Energies model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
            //return $this->goBack();
        }

        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Energies model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Energies model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Energies the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Energies::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
