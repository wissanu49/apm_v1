<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Expenses */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="expenses-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'expenses_1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'expenses_1_price')->textInput() ?>

    <?= $form->field($model, 'expenses_2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'expenses_2_price')->textInput() ?>

    <?= $form->field($model, 'expenses_3')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'expenses_3_price')->textInput() ?>

    <?= $form->field($model, 'expenses_4')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'expenses_4_price')->textInput() ?>

    <?= $form->field($model, 'expenses_5')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'expenses_5_price')->textInput() ?>

    <?= $form->field($model, 'total')->textInput() ?>

    <?= $form->field($model, 'date_record')->textInput() ?>

    <?= $form->field($model, 'users_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
