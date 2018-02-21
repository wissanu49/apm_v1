<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Leasing */

$this->title = 'เอกสารสัญญาเลขที่ : ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'สัญญาเช่า', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

