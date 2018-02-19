<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Receipt */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Receipts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="receipt-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'leasing_id',
            'room_price',
            'electric_price',
            'water_price',
            'additional_1',
            'additional_1_price',
            'additional_2',
            'additional_2_price',
            'additional_3',
            'additional_3_price',
            'additional_4',
            'additional_4_price',
            'additional_5',
            'additional_5_price',
            'refun_1',
            'refun_1_price',
            'refun_2',
            'refun_2_price',
            'total',
            'comment',
            'invoice_id',
            'users_id',
            'receipt_date',
        ],
    ]) ?>

</div>
