<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Expenses */

$this->title = 'Create Expenses';
$this->params['breadcrumbs'][] = ['label' => 'Expenses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="expenses-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
