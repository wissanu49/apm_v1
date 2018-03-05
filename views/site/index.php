<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'โปรแกรมหอพัก';
?>
<?php
foreach ($building as $build) {
    ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="box">
                <div class="box-header">
                    <h4>อาคาร : <?= $build->building_name ?></h4>
                </div>
                <div class="box-body">
                    <div class="row">
                        <?php
                        $rooms = app\models\Rooms::find()->where(['building_id' => $build->id])->all();
                        foreach ($rooms as $r) {
                            ?>
                            <div class="col-md-2 col-sm-4 col-xs-12">
                                <div class="info-box">
                                    <?php
                                    if ($r->status == 'ว่าง') {
                                        ?>
                                        <span class="info-box-icon bg-green"><i class="fa fa-bed"></i></span>
                                    <?php } else { ?>
                                        <span class="info-box-icon bg-red"><i class="fa fa-bed"></i></span>
                                    <?php } ?>
                                    <div class="info-box-content">
                                        <!--<span class="info-box-text"></span>-->
                                        <span class="info-box-number"><?= $r->name ?></span>
                                        <span class="info-box-text"><?= $r->type ?><br> <b><?= $r->status ?></b></span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </div> 
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php } ?>
<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-header">
                <h4>ใบแจ้งหนี้รอการชำระ</h4>
            </div>
            <div class="box-body">
                <div class="col-lg-12 col-xs-12">
                    <div class="table">
                        <table class="table table-bordered" style="width: 100%;">
                            <tr>
                                <th>เลขที่ใบแจ้งหนี้</th>
                                <th>ห้อง</th>
                                <th>จำนวนเงิน</th>
                                <th>กำหนดชำระ</th>
                                <th></th>
                            </tr>
                            <?php
                            foreach ($invoice as $inv) {
                                //$build_name = app\models\Building::getBuildingName();
                                $room_name = app\models\Rooms::getRoomname($inv->rooms_id);
                                ?>
                                <tr>
                                    <td><?= $inv->id ?></td>
                                    <td><?= $room_name ?></td>
                                    <td><?= $inv->total ?></td>
                                    <td><?= Yii::$app->formatter->asDate($inv->appointment) ?></td>
                                    <td><?= Html::a(' ชำระเงิน', ['receipt/payment', 'id' => $inv->id, 'leasing' => $inv->leasing_id], ['class' => 'btn btn-info fa fa-money']) ?></td>
                                </tr>
                            <?php } ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

