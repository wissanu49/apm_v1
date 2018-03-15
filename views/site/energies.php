<?php

use yii\helpers\Html;
use app\models\Receipt;
use app\models\Expenses;
use dosamigos\chartjs\ChartJs;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EnergiesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'สรุปรายได้แต่ละประเภท';
$this->params['breadcrumbs'][] = $this->title;

$year = date('Y');
$cm = date('m', strtotime('NOW'));
switch ($cm) {
    case '01' :
        $query = 1;
        break;
    case '02' :
        $query = 2;
        break;
    case '03' :
        $query = 3;
        break;
    case '04' :
        $query = 4;
        break;
    case '05' :
        $query = 5;
        break;
    case '06' :
        $query = 6;
        break;
    case '07' :
        $query = 7;
        break;
    case '07' :
        $query = 8;
        break;
    case '09' :
        $query = 9;
        break;
    case '10' :
        $query = 10;
        break;
    case '11' :
        $query = 11;
        break;
    case '12' :
        $query = 12;
        break;
}

$ThaiMonth = ['', 'มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'];
$j = 1;
for ($i = 1; $i <= $query; $i++) {
    $sum[$i] = Receipt::find()->select(['SUM(rental) as rental', 'SUM(water_price) as water_price', 'SUM(electric_price) as electric_price', 'SUM(additional_1_price) as additional_1_price','SUM(additional_2_price) as additional_2_price','SUM(additional_3_price) as additional_3_price','SUM(additional_4_price) as additional_4_price','SUM(additional_5_price) as additional_5_price'])->where(['month(receipt_date)' => $i])->all();
    $j = $i;
}
?>

<div class="row">
    <div class="col-xs-12">

        <div class="row">
            <div class="col-xs-12 col-md-12 col-lg-12">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        สรุปรายรับแต่ละประเภท <?= date('Y') + 543; ?>
                    </div><!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="table">
                            <table class="table table-hover table-bordered" style="width: 100%;">
                                
                                <tr>
                                    <th>เดือน</th>
                                    <th>ค่าเช่า</th>
                                    <th>ค่าไฟฟ้า</th>
                                    <th>ค่าน้ำปะปา</th>
                                    <th>อื่น ๆ</th>
                                    <th>รวม</th>
                                </tr>
                                <?php
                                for ($k = 1; $k <= $j; $k++) {
                                    foreach ($sum[$k] as $data) {
                                        
                                        $add = $data['additional_1_price'] +  $data['additional_2_price'] + $data['additional_3_price'] + $data['additional_4_price'] + $data['additional_5_price'];
                                        
                                        $total  = $add + $data['rental'] + $data['electric_price'] + $data['electric_price'];
                                                ?>
                                        <tr>
                                            <td><h4><?= $ThaiMonth[$k] ?></h4></td>
                                            <td><?= isset($data['rental']) ? Yii::$app->formatter->asDecimal($data['rental']) : "0.00"; ?></td>
                                            <td><?= isset($data['electric_price']) ? Yii::$app->formatter->asDecimal($data['electric_price']) : "0.00"; ?></td>
                                            <td><?= isset($data['electric_price']) ? Yii::$app->formatter->asDecimal($data['water_price']) : "0.00"; ?></td>
                                            <td><?= isset($add) ? Yii::$app->formatter->asDecimal($add) : "0.00"; ?></td>
                                            <td><h4><?= isset($total) ? Yii::$app->formatter->asDecimal($total) : "0.00"; ?></h4></td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                            </table>
                        </div>
                    </div><!-- /.panel-body -->
                </div><!-- /.panel -->
            </div> 
        </div>
    </div> 
</div>
