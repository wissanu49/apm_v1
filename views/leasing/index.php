<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\Models\SearchLeasing */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::$app->name.' : สัญญาเช่า';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php
Modal::begin([
    'headerOptions' => ['id' => 'modalHeader'],
    //'id' => 'modal',
    'size' => 'modal-lg',
    'options' => [
        'id' => 'modal',
        'tabindex' => false
    ],
]);
echo "<div id='modalContent'></div>";
echo "<div id='modalFooter' style=\"text-align:right;\">";
echo Html::button(' Closed ', ['value' => '',
                        'id' => 'close-button',
                        'class' => 'btn btn-danger fa fa-close',
                        'data-dismiss' => 'modal',
    ]);
echo "</div>";
Modal::end();
?>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="box">
            <div class="box-header">
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="table-responsive">
                <?php Pjax::begin(); ?>
                <?php // echo $this->render('_search', ['model' => $searchModel]);   ?>

                <?=
                GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        'id',
                        //'leasing_code',
                        'move_in',
                        //'move_out',
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
                        //'status',
                        //'comment:ntext',
                        [
                            'attribute' => 'status',
                            'label' => 'สถานะ',
                            'format' => 'raw',
                            'value' => function ($data) {
                                if ($data->status == "IN") {
                                    return Html::button(' เข้าอยู่ ', [
                                                'value' => NULL,
                                                //'title' => 'ออกใบแจ้งหนี้ประกันห้อง',
                                                'class' => 'btn btn-success fa fa-lock'
                                    ]);
                                } else if ($data->status == "OUT") {
                                    return Html::button(' ย้ายออกแล้ว ', [
                                                'value' => NULL,
                                                //'title' => 'ออกใบแจ้งหนี้ประกันห้อง',
                                                'class' => 'btn btn-danger fa fa-unlock'
                                    ]);
                                }else if ($data->status == "CANCEL") {
                                    return Html::button(' ยกเลิก ', [
                                                'value' => NULL,
                                                //'title' => 'ออกใบแจ้งหนี้ประกันห้อง',
                                                'class' => 'btn btn-warning fa fa-unlock'
                                    ]);
                                }
                            }
                        ],
                        [
                            'attribute' => '',
                            'label' => '',
                            'format' => 'raw',
                            'value' => function ($data) {

                                //$status = \app\models\Invoice::checkInvoice($data->id);
                                if (($status = \app\models\Invoice::checkInvoice($data->id)) == false && $data->status == 'IN') {
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
                                'update' => function ($url, $data) {
                                                                        
                                    return Html::button('', ['value' => Url::to(['leasing/update', 'id' => $data->id]),
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
</div>