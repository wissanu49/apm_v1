<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\Models\SearchInvoice */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ใบแจ้งหนี้';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <?php Pjax::begin(); ?>
<?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

                <?=
                GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        'id',
                        'leasing_id',
                        //'room_price',
                        //'electric_unit',
                        //'electric_price',
                        //'water_unit',
                        //'water_price',
                        //'additional_1',
                        //'additional_1_price',
                        //'additional_2',
                        //'additional_2_price',
                        //'additional_3',
                        //'additional_3_price',
                        //'additional_4',
                        //'additional_4_price',
                        //'additional_5',
                        //'additional_5_price',
                        //'refun_1',
                        //'refun_1_price',
                        //'refun_2',
                        //'refun_2_price',
                        'total',
                        //'comment',
                        'appointment',
                        //'status',
                        [
                          'attribute' => 'status',
                            'format' => 'raw',
                            'filter' => true,
                            'value' => function ($data){
                                return Html::button($data->status, [ NULL, 'class' => 'btn btn-warning btn-xs']);
                            }
                        ],
                        //'users_id',
                        'invoice_date',
                        [
                            'attribute' => '',
                            'format' => 'raw',
                            'value' => function ($data) {
                                return Html::a(' ชำระเงิน', ['receipt/payment', 'leasing' => $data->id], ['class' => 'btn btn-info fa fa-money']
                                );
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
