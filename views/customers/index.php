<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $searchModel app\Models\SearchCustomers */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ฐานข้อมูลลูกค้า';
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

                <p style="text-align: right;">
                    <?=
                    Html::button(' เพิ่มลูกค้ารายใหม่ ', ['value' => Url::to(['customers/create']),
                        'title' => 'เพิ่มลูกค้ารายใหม่',
                        'id' => 'showModalButton',
                        'class' => 'btn btn-success fa fa-plus'
                    ]);
                    ?>
                </p>

                <?=
                GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        //'id',
                        'fullname',
                        'address:ntext',
                        'work_address:ntext',
                        'phone',
                        //'citizen',
                        //'gender',
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
                                    return Html::button('', ['value' => Url::to(['customers/update', 'id' => $model->id]),
                                                'title' => 'แก้ไขข้อมูลลูกค้า : ' . $model->fullname,
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
