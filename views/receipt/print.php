<?php

use yii\helpers\Html;
use app\models\Numbertostring;

$NumToString = new Numbertostring();

/* @var $this yii\web\View */
/* @var $model app\models\Invoice */

$this->title = 'ใบเสร็จรับเงิน';

?>
<div class="row">
    <div class="col-lg-12">
                <?php
                foreach ($customer as $cus) {
                    $cus_name = $cus['fullname'];
                    $cus_addr = $cus['address'];
                }
                ?>

        <div class="row">
            <div class="col-lg-12">
                <table style="width: 100%; line-height: 16px">
                    <tr>
                        <td style="width: 50%;">
                            <h4>LYMRR</h4>
                        </td>
                        <td style="width: 50%; text-align: right;">
                            <h4>ใบเสร็จรับเงิน</h4>
                            <b>เลขที่ : </b><?= $model->id; ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 50%;">
                            <b>ห้อง : </b><?= \app\models\Rooms::showName($room); ?><br>
                            <b>ลูกค้า : </b><?= $cus_name ?><br>
                            <b>ที่อยู่ : </b><?= $cus_addr ?><br>
                            <b>เลขที่ใบแจ้งหนี้ : </b><?= $model->invoice_id ?>
                        </td>
                        <td style="width: 50%; text-align: right;">
                            <b>วันที่ชำระ: </b><?= $model->receipt_date ?>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <br>
                <div class="row">
                    <div class="col-lg-12">
                        <table class="table">
                            <tr>
                                <th style="width: 70%;">รายการ</th>
                                <th style="width: 30%; text-align: right;">จำนวนเงิน</th>
                            </tr>
                            <tbody>
                                <tr>
                                    <td>ค่าห้องพัก</td>
                                    <td style="text-align: right;">
                                        <?= Yii::$app->formatter->asDecimal($model->rental) ?>
                                    </td>
                                </tr>
                                <?php if ($model->deposit > 0) { ?>
                                    <tr>
                                        <td>ค่าประกันห้อง</td>
                                        <td style="text-align: right;">
                                            <?= Yii::$app->formatter->asDecimal($model->deposit) ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                                <?php if ($model->electric_price > 0) { ?>
                                    <tr>
                                        <td>ค่าไฟฟ้า</td>
                                        <td style="text-align: right;"><?= Yii::$app->formatter->asDecimal($model->electric_price) ?></td>
                                    </tr>
                                <?php } ?>
                                <?php if ($model->water_price > 0) { ?>
                                    <tr>
                                        <td>ค่าน้ำปะปา</td>
                                        <td style="text-align: right;"><?= Yii::$app->formatter->asDecimal($model->water_price) ?></td>
                                    </tr>
                                <?php } ?>
                                <?php if ($model->additional_1_price > 0) { ?>
                                <tr>
                                    <td><?= $model->additional_1 ?></td>
                                    <td style="text-align: right;"><?= Yii::$app->formatter->asDecimal($model->additional_1_price) ?></td>
                                </tr>
                                 <?php } ?>
                                <?php if ($model->additional_2_price > 0) { ?>
                                <tr>
                                    <td><?= $model->additional_2 ?></td>
                                    <td style="text-align: right;"><?= Yii::$app->formatter->asDecimal($model->additional_2_price) ?></td>
                                </tr>
                                 <?php } ?>
                                <?php if ($model->additional_3_price > 0) { ?>
                                <tr>
                                    <td><?= $model->additional_3 ?></td>
                                    <td style="text-align: right;"><?= Yii::$app->formatter->asDecimal($model->additional_3_price) ?></td>
                                </tr>
                                 <?php } ?>
                                <?php if ($model->additional_4_price > 0) { ?>
                                <tr>
                                    <td><?= $model->additional_4 ?></td>
                                    <td style="text-align: right;"><?= Yii::$app->formatter->asDecimal($model->additional_4_price) ?></td>
                                </tr>
                                 <?php } ?>
                                <?php if ($model->additional_5_price > 0) { ?>
                                <tr>
                                    <td><?= $model->additional_5 ?></td>
                                    <td style="text-align: right;"><?= Yii::$app->formatter->asDecimal($model->additional_5_price) ?></td>
                                </tr>
                                 <?php } ?>
                                <tr>
                                    <td style="text-align: right; font-size: 14px;"><b><?= $NumToString->Convert($model->total) ?></b></td>
                                    <?php
                                    //$total = $model->rental + $model->deposit;
                                    ?>
                                    <td style="text-align: right; font-size: 14px; font-weight: bold;"><?= Yii::$app->formatter->asDecimal($model->total) ?></td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="col-lg-12">
                            <b>หมายเหตุ : </b> <?= $model->comment ?>
                        </div>
                        <div class="col-lg-12">
                            <br>
                            <table style="width: 100%;">
                                <tr>
                                    <td style="width: 30%; text-align: center;">
                                        ......................................<br>
                                        ผู้ชำระ
                                    </td>
                                    <td style="width: 40%;"></td>
                                    <td style="width: 30%; text-align: center;">
                                         ......................................<br>
                                        ผู้รับเงิน
                                    </td>
                                </tr>
                            </table>
                           
                        </div>
                    </div>
                    <!-- /.col -->
                </div>


            </div>
        </div>