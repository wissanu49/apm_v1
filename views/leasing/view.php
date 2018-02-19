<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Leasing */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Leasings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="leasing-view">

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
            'move_in',
            'move_out',
            'users_id',
            'rooms_id',
            'customers_id',
            'leasing_date',
            'status',
            'comment:ntext',
            'deposit',
        ],
    ]) ?>

</div>
