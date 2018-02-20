<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Building;

/* @var $this yii\web\View */
/* @var $model app\models\Rooms */
/* @var $form yii\widgets\ActiveForm */
?>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder' => 'ชื่อห้อง/หมายเลขห้อง']) ?>

    <?php // $form->field($model, 'daily_price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'monthly_price')->textInput(['placeholder' => 'ค่าเช่าต่อเดือน']) ?>

    <?= $form->field($model, 'deposit')->textInput(['placeholder' => 'ค่าประกันห้อง [เว้นว่างได้]']) ?>

    <?= $form->field($model, 'details')->textarea(['rows' => 6, 'placeholder' => 'รายละเอียด [เว้นว่างได้]']) ?>

    <?= $form->field($model, 'type')->dropDownList([ 'ห้องพัดลม' => 'ห้องพัดลม', 'ห้องแอร์' => 'ห้องแอร์', ]) ?>

    

    <?= $form->field($model, 'building_id')->dropDownList(ArrayHelper::map(Building::getBuilding(), 'id', 'building_name'),['prompt' => 'เลือก ตึก/อาคาร']) ?>

    <div class="form-group">
        <?= Html::submitButton(' บันทึก', ['class' => 'btn btn-success fa fa-save']) ?>
    </div>

    <?php ActiveForm::end(); ?>

