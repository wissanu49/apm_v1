<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Invoice */
/* @var $form yii\widgets\ActiveForm */
$dataOption = [
    'ค่าประกันห้อง (Deposit)' => 'ค่าประกันห้อง (Deposit)',
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

$this->title = 'ออกใบแจ้งหนี้';
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
                <?= $form->field($model, 'leasing_id')->hiddenInput()->label(false) ?>

                
                <div class="row">
                    <div class="col-xs-8 table-responsive">
                        <div style="text-align: center;">
                            <h3>ใบแจ้งหนี้</h3>
                            <h3>เลขที่ : <?= $model->id ?></h3>
                        </div>
                        <div class="row">
                            <div class="col-xs-4">
                                room
                            </div>
                            <div class="col-xs-4">
                                
                            </div>
                            <div class="col-xs-4">
                                casd
                            </div>
                        </div>
                        <table class="table table-striped">
                            <tr>
                                <th style="width: 10%;">#</th>
                                <th style="width: 50%;">รายการ</th>
                                <th style="width: 30%;">จำนวนเงิน</th>
                            </tr>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>ค่าห้องพัก</td>
                                    <td>
                                        <?= $form->field($model, 'room_price')->textInput(['readonly'=>'readonly'])->label(false) ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td><?= $form->field($model, 'additional_1')->textInput(['value' => 'ค่าประกันห้อง'])->label(false) ?></td>
                                    <td><?=
                                        $form->field($model, 'additional_1_price')->textInput(['readonly'=>'readonly'])->label(false)
                                        ?></td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td><?= $form->field($model, 'additional_2')->dropDownList($dataOption, ['prompt' => ''])->label(false) ?></td>
                                    <td><?= $form->field($model, 'additional_2_price')->textInput(['placeholder' => ''])->label(false) ?></td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td><?= $form->field($model, 'additional_3')->dropDownList($dataOption, ['prompt' => ''])->label(false) ?></td>
                                    <td><?= $form->field($model, 'additional_3_price')->textInput(['placeholder' => ''])->label(false) ?></td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td><?= $form->field($model, 'additional_4')->dropDownList($dataOption, ['prompt' => ''])->label(false) ?></td>
                                    <td><?= $form->field($model, 'additional_4_price')->textInput(['placeholder' => ''])->label(false) ?></td>
                                </tr>
                                <tr>
                                    <td>6</td>
                                    <td><?= $form->field($model, 'additional_5')->dropDownList($dataOption, ['prompt' => ''])->label(false) ?></td>
                                    <td><?= $form->field($model, 'additional_5_price')->textInput(['placeholder' => ''])->label(false) ?></td>
                                </tr>
                                <tr>
                                    <td>7</td>
                                    <td>รวม</td>
                                    <?php
                                    $total = $model->room_price + $model->additional_1_price;
                                    ?>
                                    <td><?= $form->field($model, 'total')->textInput(['value' => $total, 'readonly'=>'readonly'])->label(false) ?></td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="col-lg-6">
                            <?=
                            $form->field($model, 'appointment')->widget(Datepicker::className(), [
                                'template' => '{input}{addon}',
                                'options' => ['placeholder' => 'วันกำหนดชำระ'],
                                'value' => NULL,
                                'language' => 'th',
                                'clientOptions' => [
                                    'autoclose' => true,
                                    'format' => 'yyyy-mm-dd',
                                    'todayHighlight' => true,
                                ]
                            ])
                            ?>
                        </div>
                        <div class="col-lg-6">
                            <?= $form->field($model, 'comment')->textarea(['rows' => 5]) ?>
                        </div>

                        <?php // $form->field($model, 'status')->dropDownList(['waiting' => 'Waiting', 'payment' => 'Payment',], ['prompt' => ''])  ?>

                        <?= $form->field($model, 'users_id')->hiddenInput()->label(false) ?>

                        <?= $form->field($model, 'invoice_date')->hiddenInput()->label(false) ?>

                        <div class="form-group">
                            <?= Html::submitButton(' บันทึก', ['class' => 'btn btn-success fa fa-save']) ?>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>



                <?php // $form->field($model, 'id')->textInput(['maxlength' => true, 'readonly' => 'readonly'])    ?>


                <?php //$form->field($model, 'total')->textInput()  ?>



                <?php ActiveForm::end(); ?>

            </div>
            <?php
            $this->RegisterJs("
    $('document').ready(function(){
          
        $('#" . Html::getInputId($model, 'additional_1_price') . "').change(function(e){ 
           TotalCal();
        });
        $('#" . Html::getInputId($model, 'additional_2_price') . "').change(function(e){ 
           TotalCal();
        });
        $('#" . Html::getInputId($model, 'additional_3_price') . "').change(function(e){ 
           TotalCal();
        });
        $('#" . Html::getInputId($model, 'additional_4_price') . "').change(function(e){ 
           TotalCal();
        });
        $('#" . Html::getInputId($model, 'additional_5_price') . "').change(function(e){ 
           TotalCal();
        });
        

        function TotalCal(){
            var amount = 0;
            var room = 0;
            var a1 = 0;
            var a2 = 0;
            var a3 = 0;
            var a4 = 0;
            var a5 = 0;
            var total = 0;
            
            amount = parseInt($('#" . Html::getInputId($model, 'total') . "').val());
            room = parseInt($('#" . Html::getInputId($model, 'room_price') . "').val());
            a1 = parseInt($('#" . Html::getInputId($model, 'additional_1_price') . "').val());
            a2 = parseInt($('#" . Html::getInputId($model, 'additional_2_price') . "').val());
            a3 = parseInt($('#" . Html::getInputId($model, 'additional_3_price') . "').val());
            a4 = parseInt($('#" . Html::getInputId($model, 'additional_4_price') . "').val());
            a5 = parseInt($('#" . Html::getInputId($model, 'additional_5_price') . "').val());
            
            if(!isNaN(a1) && a1.length != 0){
                total += a1;
            }
            if(!isNaN(a2) && a2.length != 0){
                total += a2;
            }
            if(!isNaN(a3) && a3.length != 0){
                total += a3;
            }
            if(!isNaN(a4) && a4.length != 0){
                total += a4;
            }
            if(!isNaN(a5) && a5.length != 0){
                total += a5;
            }
            
            total += room;          
            $('#" . Html::getInputId($model, 'total') . "').val(total);  
        }
        
    });

    ");
            ?>
        </div>
    </div>
</div>
