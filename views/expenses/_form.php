<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Expenses */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
            </div>
            <!-- /.box-header -->
            <div class="box-body">

                <?php $form = ActiveForm::begin(); ?>

                <table class="table table-striped">
                    <tr>
                        <th style="width: 50%;">รายการ</th>
                        <th style="width: 30%;">จำนวนเงิน</th>
                    </tr>
                    <tbody>
                        <tr>
                            <td>
                                <?= $form->field($model, 'expenses_1')->textInput(['placeholder' => 'รายการค่าใช้จ่าย...'])->label(false) ?>  
                            </td>
                            <td>
                                <?= $form->field($model, 'expenses_1_price')->textInput()->label(false) ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <?= $form->field($model, 'expenses_2')->textInput(['placeholder' => 'รายการค่าใช้จ่าย...'])->label(false) ?>  
                            </td>
                            <td>
                                <?= $form->field($model, 'expenses_2_price')->textInput()->label(false) ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <?= $form->field($model, 'expenses_3')->textInput(['placeholder' => 'รายการค่าใช้จ่าย...'])->label(false) ?>  
                            </td>
                            <td>
                                <?= $form->field($model, 'expenses_3_price')->textInput()->label(false) ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <?= $form->field($model, 'expenses_4')->textInput(['placeholder' => 'รายการค่าใช้จ่าย...'])->label(false) ?>  
                            </td>
                            <td>
                                <?= $form->field($model, 'expenses_4_price')->textInput()->label(false) ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <?= $form->field($model, 'expenses_5')->textInput(['placeholder' => 'รายการค่าใช้จ่าย...'])->label(false) ?>  
                            </td>
                            <td>
                                <?= $form->field($model, 'expenses_5_price')->textInput()->label(false) ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: right;"><h4>รวม</h4></td>
                            <td> <?= $form->field($model, 'total')->textInput(['readonly' => 'readonly'])->label(false) ?></td>
                        </tr>
                        <tr>
                            <td> <?=
                                $form->field($model, 'date_record')->widget(
                                        DatePicker::className(), [
                                    // inline too, not bad
                                    //'inline' => true, 
                                    // modify template for custom rendering
                                    //'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
                                    'template' => '{input}{addon}',
                                    'options' => ['placeholder' => 'วันที่ทำรายการ...'],
                                    'value' => date('Y-m-d'),
                                    'language' => 'th',
                                    'clientOptions' => [
                                        'autoclose' => true,
                                        'format' => 'yyyy-mm-dd',
                                        'todayHighlight' => true,
                                    ]
                                ]);
                                ?></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>

                <?= $form->field($model, 'users_id')->hiddenInput(['value' => Yii::$app->user->identity->id])->label(false) ?>
                 <?= $form->field($model, 'id')->hiddenInput()->label(false) ?>

                <div class="form-group">
                    <?= Html::submitButton(' บันทึก', ['class' => 'btn btn-success fa fa-save']) ?>
                </div>

                <?php ActiveForm::end(); ?>

                <?php
                
                $this->RegisterJs("
    $('document').ready(function(){
          
         TotalCal();
        $('#" . Html::getInputId($model, 'expenses_1_price') . "').change(function(e){ 
           TotalCal();
        });
        $('#" . Html::getInputId($model, 'expenses_2_price') . "').change(function(e){ 
           TotalCal();
        });
        $('#" . Html::getInputId($model, 'expenses_3_price') . "').change(function(e){ 
           TotalCal();
        });
        $('#" . Html::getInputId($model, 'expenses_4_price') . "').change(function(e){ 
           TotalCal();
        });
        $('#" . Html::getInputId($model, 'expenses_5_price') . "').change(function(e){ 
           TotalCal();
        });
        

        function TotalCal(){
            var a1 = 0;
            var a2 = 0;
            var a3 = 0;
            var a4 = 0;
            var a5 = 0;
            var total = 0;
            
            a1 = parseInt($('#" . Html::getInputId($model, 'expenses_1_price') . "').val());
            a2 = parseInt($('#" . Html::getInputId($model, 'expenses_2_price') . "').val());
            a3 = parseInt($('#" . Html::getInputId($model, 'expenses_3_price') . "').val());
            a4 = parseInt($('#" . Html::getInputId($model, 'expenses_4_price') . "').val());
            a5 = parseInt($('#" . Html::getInputId($model, 'expenses_5_price') . "').val());
            
            
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
                    
            $('#" . Html::getInputId($model, 'total') . "').val(total);  
        }
        
    });

    ");
                ?>
            </div>
        </div>
    </div>
</div>
