<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Invoice */
/* @var $form yii\widgets\ActiveForm */
$dataOption = [
    'ค่ามัดจำ (Deposit)' => 'ค่ามัดจำ (Deposit)',
    'ค่าส่วนกลาง (Facility)' => 'ค่าส่วนกลาง (Facility)',
    'ค่าโทรศัพท์ (Telephone)' => 'ค่าโทรศัพท์ (Telephone)',
    'ค่าเคเบิลทีวี (Cable TV)' => 'ค่าเคเบิลทีวี (Cable TV)',
    'ค่าปรับ (Penalty fee)' => 'ค่าปรับ (Penalty fee)',
    'ค่าซ่อมบำรุง (Maintenance)' => 'ค่าซ่อมบำรุง (Maintenance)',
    'ค่าซ่อมบำรุง (Maintenance)' => 'ค่าซ่อมบำรุง (Maintenance)',
    'ค่าเช่าเฟอร์นิเจอร์ (Furniture)' => 'ค่าเช่าเฟอร์นิเจอร์ (Furniture)',
    'ค่าบริการ (Service)' => 'ค่าบริการ (Service)',
    'ค้างจ่าย (Arrears)' => 'ค้างจ่าย (Arrears)',
];
?>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
            </div>
            <!-- /.box-header -->
            <div class="box-body">

                <?php $form = ActiveForm::begin(); ?>
                <!-- Table row -->
                <?= $form->field($model, 'leasing_id')->textInput(['maxlength' => true, 'readonly' => 'readonly']) ?>
                <div class="row">
                    <div class="col-xs-8 table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 10%;">#</th>
                                    <th style="width: 50%;">รายการ</th>
                                    <th style="width: 30%;">จำนวนเงิน</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>ค่าห้องพัก</td>
                                    <td>
                                        <?= $form->field($model, 'room_price')->textInput(['value' => \app\models\Rooms::getPrice($room)])->label(false) ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td><?= $form->field($model, 'additional_1')->dropDownList($dataOption, ['prompt' => ''])->label(false) ?></td>
                                    <td><?=
                                        $form->field($model, 'additional_1_price')->textInput(['placeholder' => 'เว้นว่างได้'])->label(false)
                                        ?></td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td><?= $form->field($model, 'additional_2')->dropDownList($dataOption, ['prompt' => ''])->label(false) ?></td>
                                    <td><?= $form->field($model, 'additional_2_price')->textInput(['placeholder' => 'เว้นว่างได้'])->label(false) ?></td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td><?= $form->field($model, 'additional_2')->dropDownList($dataOption, ['prompt' => ''])->label(false) ?></td>
                                    <td><?= $form->field($model, 'additional_2_price')->textInput(['placeholder' => 'เว้นว่างได้'])->label(false) ?></td>
                                </tr>
                                 <tr>
                                    <td>5</td>
                                    <td><?= $form->field($model, 'additional_2')->dropDownList($dataOption, ['prompt' => ''])->label(false) ?></td>
                                    <td><?= $form->field($model, 'additional_2_price')->textInput(['placeholder' => 'เว้นว่างได้'])->label(false) ?></td>
                                </tr>
                                <tr>
                                    <td>6</td>
                                    <td><?= $form->field($model, 'additional_2')->dropDownList($dataOption, ['prompt' => ''])->label(false) ?></td>
                                    <td><?= $form->field($model, 'additional_2_price')->textInput(['placeholder' => 'เว้นว่างได้'])->label(false) ?></td>
                                </tr>
                                 <tr>
                                    <td>6</td>
                                    <td>รวม</td>
                                    <td><?= $form->field($model, 'total')->textInput(['placeholder' => 'เว้นว่างได้'])->label(false) ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.col -->
                </div>



                <?php // $form->field($model, 'id')->textInput(['maxlength' => true, 'readonly' => 'readonly'])  ?>
              

                <?php //$form->field($model, 'total')->textInput() ?>

                <?= $form->field($model, 'comment')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'appointment')->textInput() ?>

                <?php // $form->field($model, 'status')->dropDownList(['waiting' => 'Waiting', 'payment' => 'Payment',], ['prompt' => '']) ?>

                <?= $form->field($model, 'users_id')->hiddenInput()->label(false) ?>

                <?= $form->field($model, 'invoice_date')->hiddenInput()->label(false) ?>

                <div class="form-group">
                    <?= Html::submitButton(' บันทึก', ['class' => 'btn btn-success fa fa-save']) ?>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>
</div>
