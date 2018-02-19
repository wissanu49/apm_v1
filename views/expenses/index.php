<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\Models\SearchExpenses */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Expenses';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="expenses-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Expenses', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'expenses_1',
            'expenses_1_price',
            'expenses_2',
            'expenses_2_price',
            //'expenses_3',
            //'expenses_3_price',
            //'expenses_4',
            //'expenses_4_price',
            //'expenses_5',
            //'expenses_5_price',
            //'total',
            //'date_record',
            //'users_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
