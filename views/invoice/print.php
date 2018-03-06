<?php

use yii\helpers\Html;
use app\models\Numbertostring;

$NumToString = new Numbertostring();

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
    $electric_unit_from = $data['electric_unit_from'];
    $electric_unit_to = $data['electric_unit_to'];
    $water_unit_from = $data['water_unit_from'];
    $water_unit_to = $data['water_unit_to'];
    $water_price = $data['water_price'];
    $electric_price = $data['electric_price'];
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
    $r1 = $data['refun_1'];
    $re1 = $data['refun_1_price'];
    $r2 = $data['refun_2'];
    $re2 = $data['refun_2_price'];
    $total = $data['total'];
    $room = $data['room'];
    $cus_name = $data['fullname'];
    $cus_addr = $data['address'];
    $appointment = $data['appointment'];
    $comment = $data['comment'];
}

$this->title = 'ใบแจ้งหนี้เลขที่ : ' . $inv_id;
?>
<div class="row">
    <div class="col-lg-12 ">
        <div class="row">
            <div class="col-lg-12">
                <table style="width: 100%">
                    <tr>
                        <td style="width: 50%;">
                            <h4>LYMRR</h4>
                        </td>
                        <td style="width: 50%; text-align: right;">
                            
                            <h4>ใบแจ้งหนี้</h4>
                            <b>เลขที่ : </b><?= $inv_id; ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 50%;">
                            <h4>ห้อง : <?= $room ?></h4>
                            <b>ลูกค้า : </b><?= $cus_name ?><br>
                            <b>ที่อยู่ : </b><?= $cus_addr ?>
                        </td>
                        <td style="width: 50%; text-align: right;">
                            
                            <b>กำหนดชำระ: </b><?= $appointment ?>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <br>
        <table class="table table-borderless">
            <tr>
                <td style="width: 70%;">
                    <table class="table" style="width: 100%;">
                        <tr>
                            <th style="width: 70%;">รายการ</th>
                            <th style="width: 30%;text-align: right;">จำนวนเงิน</th>
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
                            if ($water_price > 0) {
                                ?>
                                <tr>
                                    <td>ค่าน้ำ ( <?= $water_unit_from . " - " . $water_unit_to ?>)</td>
                                    <td style="text-align: right;">
                                        <?= Yii::$app->formatter->asDecimal($water_price) ?>
                                    </td>
                                </tr>
                            <?php } ?>
                            <?php
                            if ($electric_price > 0) {
                                ?>
                                <tr>
                                    <td>ค่าไฟฟ้า ( <?= $electric_unit_from . " - " . $electric_unit_to ?>)</td>
                                    <td style="text-align: right;">
                                        <?= Yii::$app->formatter->asDecimal($electric_price) ?>
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
                                <td style="text-align: right;"><b><?= $NumToString->Convert($total) ?></b></td>
                                <td style="text-align: right; font-size: 12px;"><b><?= Yii::$app->formatter->asDecimal($total); ?></b></td>
                            </tr>
                            <tr>
                                <td style="text-align: left;"><b>หมายเหตุ :</b>
                                    <?= $comment ?>
                                </td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </table>

        <br>
    </div>
</div>
