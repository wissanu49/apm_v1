<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Leasing */

$this->title = 'Create Leasing';
$this->params['breadcrumbs'][] = ['label' => 'Leasings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="leasing-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
