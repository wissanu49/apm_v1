<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\Models\SearchReceipt */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ใบเสร็จรับเงิน';
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
                        //'leasing_id',
                        'invoice_id',
                        //'rental',
                        //'electric_price',
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
                        //'total',
                        [
                            'attribute' => 'total',
                            'filter' => false,
                            'value' => function ($data) {
                                return Yii::$app->formatter->asDecimal($data->total);
                            }
                        ],
                        //'comment',
                        //'users_id',
                        //'receipt_date',
                        [
                            'attribute' => 'receipt_date',
                            'value' => 'receipt_date',
                            'filter' => false,
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
                                    return Html::button('', ['value' => Url::to(['receipt/viewreceipt', 'id' => $model->id, 'leasing' => $model->leasing_id]),
                                                'title' => 'ใบเสร็จรับเงิน',
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