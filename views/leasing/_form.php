<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Leasing */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin(); ?>

<?php // $form->field($model, 'id')->textInput(['maxlength' => true, 'disabled' => true]) ?>
<?= $form->field($model, 'id')->hiddenInput()->label(false) ?>
<?=
$form->field($model, 'rooms_id')->dropDownList(
        ArrayHelper::map(app\models\Rooms::find()->all(), 'id', 'name'), ['disabled' => true])
?>

<?= $form->field($model, 'customers_id')->dropDownList(ArrayHelper::map(app\models\Customers::find()->select(['id', 'fullname'])->all(), 'id', 'fullname'), ['prompt' => 'เลือกผู้เช่า']) ?>

<?=
$form->field($model, 'move_in')->widget(
        DatePicker::className(), [
    // inline too, not bad
    //'inline' => true, 
    // modify template for custom rendering
    //'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
    'template' => '{input}{addon}',
    'options' => ['placeholder' => 'วันที่ย้ายออก'],
    'value' => date('Y-m-d'),
    'language' => 'th',
    'clientOptions' => [
        'autoclose' => true,
        'format' => 'yyyy-mm-dd',
        'todayHighlight' => true,
    ]
]);
?>

<?php /*
$form->field($model, 'move_out')->widget(
        DatePicker::className(), [
    // inline too, not bad
    //'inline' => true, 
    // modify template for custom rendering
    //'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
    'template' => '{input}{addon}',
    'options' => ['placeholder' => 'วันที่ย้ายออก'],
    'value' => NULL,
    'language' => 'th',
    'clientOptions' => [
        'autoclose' => true,
        'format' => 'yyyy-mm-dd',
        'todayHighlight' => true,
    ]
]);
 * 
 */
?>

<?php // $form->field($model, 'users_id')->hiddenInput()->label(false) ?>


<?php // $form->field($model, 'leasing_date')->textInput() ?>

<?= $form->field($model, 'status')->dropDownList(['IN' => 'IN', 'CANCEL' => 'CANCEL',]) ?>

<?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>

<?= $form->field($model, 'deposit')->textInput(['value' => isset($model->rooms_id) ? $model->rooms->deposit : NULL, 'readonly'=>'readonly']) ?>

<div class="form-group">
    <?= Html::submitButton(' บันทึก', ['class' => 'btn btn-success fa fa-save']) ?>
</div>

<?php ActiveForm::end(); ?>

