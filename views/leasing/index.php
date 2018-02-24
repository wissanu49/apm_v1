<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\Models\SearchLeasing */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'สัญญาเช่า';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php
Modal::begin([
    'headerOptions' => ['id' => 'modalHeader'],
    'id' => 'modal',
    'size' => 'modal-lg',
]);
echo "<div id='modalContent'></div>";
Modal::end();
?>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <?php Pjax::begin(); ?>
                <?php // echo $this->render('_search', ['model' => $searchModel]);   ?>

                <?=
                GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        'id',
                        'leasing_code',
                        'move_in',
                        'move_out',
                        //'users_id',
                        [
                            'attribute' => 'rooms_id',
                            'label' => 'ห้องพัก',
                            //'format' => 'raw',
                            'value' => 'rooms.name',
                        ],
                        [
                            'attribute' => 'customers_id',
                            'label' => 'ผู้เช่า',
                            //'format' => 'raw',
                            'value' => 'customers.fullname',
                        ],
                        'leasing_date',
                        'status',
                        'comment:ntext',
                        [
                            'attribute' => 'status',
                            'label' => 'สถานะ',
                            'format' => 'raw',
                            'value' => function ($data) {
                                if ($data->status == "IN") {
                                    return Html::button(' เข้าอยู่ ', [
                                                'value' => NULL,
                                                'title' => 'ออกใบแจ้งหนี้ประกันห้อง',
                                                'class' => 'btn btn-success fa fa-lock'
                                    ]);
                                } else if ($data->status == "OUT") {
                                    return Html::button(' ย้ายออก ', [
                                                'value' => NULL,
                                                'title' => 'ออกใบแจ้งหนี้ประกันห้อง',
                                                'class' => 'btn btn-success fa fa-unlock'
                                    ]);
                                }
                            }
                        ],
                        [
                            'attribute' => '',
                            'label' => 'ใบแจ้งหนี้',
                            'format' => 'raw',
                            'value' => function ($data) {

                                //$status = \app\models\Invoice::checkInvoice($data->id);
                                if (($status = \app\models\Invoice::checkInvoice($data->id)) == false) {
                                    return Html::a('ออกใบแจ้งหนี้ประกันห้อง', ['invoice/deposit', 'leasing' => $data->id], ['class' => 'btn btn-info fa fa-edit']);
                                }else{
                                    return '';
                                }
                            }
                        ],
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'visibleButtons' => [
                                'view' => function ($model, $key, $index) {
                                    return false;
                                },
                                'delete' => function ($model, $key, $index) {
                                    return false;
                                },
                            ],
                            'template' => '{update}',
                            'buttons' => [
                                'update' => function ($url, $model) {
                                    return Html::button('', ['value' => Url::to(['leasing/update', 'id' => $model->id]),
                                                'title' => 'ข้อมูลสัญญาเช่า',
                                                'id' => 'showModalButton',
                                                'class' => 'btn btn-primary fa fa-edit'
                                    ]);
                                },
                            ],
                        ],
                    ],
                ]);
                ?>
                <?php Pjax::end(); ?>
            </div>
        </div>
    </div>
</div>