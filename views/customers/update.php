<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Customers */

$this->title = 'แก้ไขข้อมูล : ' . $model->fullname;
$this->params['breadcrumbs'][] = ['label' => 'ฐานข้อมูลลูกค้า', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'แก้ไขข้อมูล';
?>
<div class="customers-create">
    <div class="row">
        <div class="col-lg-3"></div>
        <div class="col-lg-6">
            <?=
            $this->render('_form', [
                'model' => $model,
            ])
            ?>
        </div>
        <div class="col-lg-3"></div>

    </div>

