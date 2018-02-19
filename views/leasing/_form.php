<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Leasing */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="leasing-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'move_in')->textInput() ?>

    <?= $form->field($model, 'move_out')->textInput() ?>

    <?= $form->field($model, 'users_id')->textInput() ?>

    <?= $form->field($model, 'rooms_id')->textInput() ?>

    <?= $form->field($model, 'customers_id')->textInput() ?>

    <?= $form->field($model, 'leasing_date')->textInput() ?>

    <?= $form->field($model, 'status')->dropDownList([ 'IN' => 'IN', 'OUT' => 'OUT', 'CANCEL' => 'CANCEL', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'deposit')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
