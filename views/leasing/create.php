<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Leasing */

$this->title = 'Create Leasing';
$this->params['breadcrumbs'][] = ['label' => 'Leasings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

