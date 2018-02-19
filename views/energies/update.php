<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Energies */

$this->title = 'Update Energies: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Energies', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="energies-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
