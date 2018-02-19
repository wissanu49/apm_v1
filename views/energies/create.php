<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Energies */

$this->title = 'Create Energies';
$this->params['breadcrumbs'][] = ['label' => 'Energies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-xs-3"></div>
    <div class="col-xs-6">
        <div class="box">
            <div class="box-header">
            </div>
            <!-- /.box-header -->
            <div class="box-body">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
            </div>
        </div>
    </div>
    <div class="col-xs-3"></div>
</div>
