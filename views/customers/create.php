<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Customers */

$this->title = 'เพิ่มลูกค้าใหม่';
$this->params['breadcrumbs'][] = ['label' => 'ฐานข้อมูลลูกค้า', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customers-create">
<div class="row">
    <div class="col-lg-3"></div>
    <div class="col-lg-6">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

 </div>
    <div class="col-lg-3"></div>

</div>
