<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Energies */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin([
    'class' => 'form-control'
]); ?>

<?= $form->field($model, 'rooms_id')->hiddenInput()->label(FALSE) ?>


<?= DatePicker::widget([
    'model' => $model,
    'attribute' => 'peroid',
    'template' => '{input}{addon}',
    'options' => ['placeholder' => 'รอบวันที่...'],
        'clientOptions' => [
            'autoclose' => true,
            'format' => 'dd-mm-yyyy',
            'todayHighlight' => true,
            'language' => 'th'
        ]
]);?>

<?= $form->field($model, 'water_unit')->textInput(['placeholder' => 'เลขมิเตอร์น้ำปะปา']) ?>

<?= $form->field($model, 'electric_unit')->textInput(['placeholder' => 'เลขมิเตอร์ไฟฟ้า']) ?>



<?php // $form->field($model, 'users_id')->textInput() ?>

<?php // $form->field($model, 'record_date')->textInput() ?>

<div class="form-group">
<?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm::end(); ?>

