<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\Models\SearchLeasing */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Leasings';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="leasing-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Leasing', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'move_in',
            'move_out',
            'users_id',
            'rooms_id',
            //'customers_id',
            //'leasing_date',
            //'status',
            //'comment:ntext',
            //'deposit',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
