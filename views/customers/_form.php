<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

/* @var $this yii\web\View */
/* @var $model app\models\Customers */
/* @var $form yii\widgets\ActiveForm */
?>


<?php
$form = ActiveForm::begin();
?>

<?= $form->field($model, 'gender')->dropDownList(['ชาย' => 'ชาย', 'หญิง' => 'หญิง',], ['prompt' => 'เพศ', 'class' => 'form-control']) ?>

<?= $form->field($model, 'fullname')->textInput(['maxlength' => true, 'placeholder' => 'ชื่อ-นามสกุล', 'class' => 'form-control']) ?>

<?=
$form->field($model, 'citizen')->widget(MaskedInput::className(), [
    'mask' => '9-9999-99999-99-9',
])
?>       

<?= $form->field($model, 'address')->textarea(['rows' => 6, 'placeholder' => 'ที่อยู่']) ?>

<?= $form->field($model, 'work_address')->textarea(['rows' => 6, 'placeholder' => 'สถานที่ทำงาน']) ?>

<?= $form->field($model, 'phone')->textInput(['maxlength' => true, 'placeholder' => 'เบอร์โทรศัพท์']) ?>  


<div class="form-group">
    <?= Html::submitButton(' บันทึก', ['class' => 'btn btn-success fa fa-save']) ?>
</div>

<?php ActiveForm::end(); ?>
   
