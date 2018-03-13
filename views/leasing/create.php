<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Leasing */

$this->title = 'ทำสัญญาเช่า';
$this->params['breadcrumbs'][] = ['label' => 'สัญญาเช่า', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-header">
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <?=
                $this->render('_form', [
                    'model' => $model,
                ])
                ?>
            </div>
        </div>
    </div>
</div>

