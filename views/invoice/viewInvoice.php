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

foreach ($dataProvider as $data) {
    $inv_id = $data['id'];
    $rental = $data['rental'];
    $deposit = $data['deposit'];
    $a1 = $data['additional_1'];
    $ad1 = $data['additional_1_price'];
    $a2 = $data['additional_2'];
    $ad2 = $data['additional_2_price'];
    $a3 = $data['additional_3'];
    $ad3 = $data['additional_3_price'];
    $a4 = $data['additional_4'];
    $ad4 = $data['additional_4_price'];
    $a5 = $data['additional_5'];
    $ad5 = $data['additional_5_price'];
    $total = $data['total'];
    $room = $data['room'];
    $cus_name = $data['fullname'];
    $cus_addr = $data['address'];
    $appointment = $data['appointment'];
}

$this->title = 'ใบแจ้งหนี้เลขที่ : ' . $inv_id;
?>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <!-- Table row -->

                <div class="row">
                    <div class="col-xs-12 table-responsive">
                        <div class="row">

                            <div class="col-lg-6" style="text-align: left;">
                                <h4>LYMRR</h4>
                            </div>
                            <div class="col-lg-6" style="text-align: right;">
                                <h4>ใบแจ้งหนี้</h4>
                                <b>เลขที่ : </b><?= $inv_id; ?>
                            </div>


                        </div>
                        <div class="row">
                            <div class="col-xs-6">
                                <b>ห้อง : </b><?= $room ?><br>
                                <b>ลูกค้า : </b><?= $cus_name ?><br>
                                <b>ที่อยู่ : </b><?= $cus_addr ?>
                            </div>
                            <div class="col-xs-6" style="text-align: right;">
                                <br><br>
                                <b>กำหนดชำระวันที่ : </b><?= $appointment ?>
                            </div>
                        </div>
                        <br>
                        <table class="table table-striped">
                            <tr>
                                <th style="width: 70%;">รายการ</th>
                                <th style="width: 30%;">จำนวนเงิน</th>
                            </tr>
                            <tbody>
<?php
if ($rental != NULL) {
    ?>
                                    <tr>
                                        <td>ค่าห้องพัก</td>
                                        <td style="text-align: right;">
    <?= Yii::$app->formatter->asDecimal($rental) ?>
                                        </td>
                                    </tr>
<?php } ?>
                                <?php
                                if ($deposit != NULL) {
                                    ?>
                                    <tr>
                                        <td>ค่าประกันห้อง</td>
                                        <td style="text-align: right;">
    <?= Yii::$app->formatter->asDecimal($deposit) ?>
                                        </td>
                                    </tr>
<?php } ?>
                                <?php
                                if ($ad1 > 0) {
                                    ?>
                                    <tr>
                                        <td><?= $a1 ?></td>
                                        <td style="text-align: right;">
    <?= Yii::$app->formatter->asDecimal($ad1) ?>
                                        </td>
                                    </tr>
<?php } ?>
                                <?php
                                if ($ad2 > 0) {
                                    ?>
                                    <tr>
                                        <td><?= $a2 ?></td>
                                        <td style="text-align: right;">
    <?= Yii::$app->formatter->asDecimal($ad2) ?>
                                        </td>
                                    </tr>
<?php } ?>
                                <?php
                                if ($ad3 > 0) {
                                    ?>
                                    <tr>
                                        <td><?= $a3 ?></td>
                                        <td style="text-align: right;">
    <?= Yii::$app->formatter->asDecimal($ad3) ?>
                                        </td>
                                    </tr>
<?php } ?>
                                <?php
                                if ($ad4 > 0) {
                                    ?>
                                    <tr>
                                        <td><?= $a4 ?></td>
                                        <td style="text-align: right;">
    <?= Yii::$app->formatter->asDecimal($ad4) ?>
                                        </td>
                                    </tr>
<?php } ?>
                                <?php
                                if ($ad5 > 0) {
                                    ?>
                                    <tr>
                                        <td><?= $a5 ?></td>
                                        <td style="text-align: right;">
    <?= Yii::$app->formatter->asDecimal($ad5) ?>
                                        </td>
                                    </tr>
<?php } ?>
                                <tr>
                                    <td style="text-align: right; font-size: 16px;"><b>ราคารวม</b></td>
                                    <td style="text-align: right;"><?= Yii::$app->formatter->asDecimal($total); ?></td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                    <!-- /.col -->
                </div>


            </div>
        </div>
    </div>
</div>