<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $searchModel app\Models\SearchInvoice */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ใบแจ้งหนี้';
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
                        [
                            'attribute' => 'total',
                            //'filter' => true,
                            'value' => function ($data) {
                                return Yii::$app->formatter->asDecimal($data->total);
                            }
                        ],
                        //'comment',
                        'appointment',
                        //'status',
                        [
                            'attribute' => 'status',
                            'format' => 'raw',
                            'filter' => true,
                            'value' => function ($data) {
                                if ($data->status == 'รอการชำระ') {
                                    return Html::button($data->status, [NULL, 'class' => 'btn btn-danger btn-xs']);
                                }else{
                                    return Html::button($data->status, [NULL, 'class' => 'btn btn-success btn-xs']);
                                }
                            }
                        ],
                        //'users_id',
                        'invoice_date',
                        [
                            'attribute' => '',
                            'format' => 'raw',
                            'value' => function ($data) {
                                if ($data->status == 'รอการชำระ') {
                                    return Html::a(' ชำระเงิน', ['receipt/payment', 'id' => $data->id, 'leasing' => $data->leasing_id], ['class' => 'btn btn-info fa fa-money']
                                    );
                                } else {
                                    return "&nbsp;";
                                }
                            }
                        ],
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'visibleButtons' => [
                                'update' => function ($model, $key, $index) {
                                    return false;
                                },
                                'delete' => function ($model, $key, $index) {
                                    return false;
                                },
                            ],
                            'template' => '{view}',
                            'buttons' => [
                                'view' => function ($url, $model) {
                                    return Html::button('', ['value' => Url::to(['invoice/view', 'id' => $model->id]),
                                                'title' => 'ข้อมูลใบแจ้งหนี้',
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
