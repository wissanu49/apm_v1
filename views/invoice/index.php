<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\Models\SearchInvoice */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Invoices';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="invoice-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Invoice', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'leasing_id',
            'room_price',
            'electric_unit',
            'electric_price',
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
            //'total',
            //'comment',
            //'appointment',
            //'status',
            //'users_id',
            //'invoice_date',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
