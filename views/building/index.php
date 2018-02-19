<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\Models\SearchBuilding */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ตึก/อาคาร';
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
                    Html::button(' เพิ่มอาคารใหม่ ', ['value' => Url::to(['building/create']),
                        'title' => 'เพิ่มอาคารใหม่',
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
                        'building_name',
                        'building_address',
                        [
                            'attribute' => '',
                            'label' => 'บริหารห้องพัก',
                            'format' => 'raw',
                            'value' => function($data) {
                                return Html::a(' บริหารห้องพัก', ['building/rooms', 'id' => $data['id']], ['title' => 'บริหารห้องพัก : ' . $data['building_name'],
                                            //'id' => 'showModalButton',
                                            'class' => 'btn btn-info fa fa-bed']);
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
                                    return Html::button('', ['value' => Url::to(['building/update', 'id' => $model->id]),
                                                'title' => 'แก้ไขข้อมูล : ' . $model->building_name,
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
