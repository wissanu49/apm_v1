<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/maleuser.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?= Yii::$app->user->identity->username   ?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>


        <?=
        dmstr\widgets\Menu::widget(
                [
                    'options' => ['class' => 'sidebar-menu tree', 'data-widget' => 'tree'],
                    //'options' => ['class' => 'navbar navbar-static-top', 'data-widget'=> 'tree'],
                    'items' => [
                        ['label' => 'HOME', 'options' => ['class' => 'header']],
                        ['label' => 'หน้าหลัก', 'icon' => 'home', 'url' => ['/site']],
                        ['label' => 'ข้อมูลลูกค้า', 'icon' => 'users', 'url' => ['/customers']],
                        ['label' => 'ตึก/อาคาร', 'icon' => 'building', 'url' => ['/building']],
                        ['label' => 'ห้องพัก', 'icon' => 'bed', 'url' => ['/rooms']],                        
                        ['label' => 'สัญญาเช่า', 'url' => ['/leasing']],
                        /*
                        [
                            'label' => 'บันทึกค่าไฟฟ้า/ปะปา',
                            'icon' => 'gears',
                            'url' => '#',
                            'items' => [
                                ['label' => 'บันทึกหน่วยไฟฟ้า', 'icon' => 'flash', 'url' => ['/recordenergies/electric'],],
                                ['label' => 'บันทึกหน่วยปะปา', 'icon' => 'database', 'url' => ['/recordenergies/water'],],
                            ],
                        ],
                         * 
                         */
                        ['label' => 'ใบแจ้งหนี้','icon' => 'file', 'url' => ['/invoice']],
                        ['label' => 'ใบเสร็จรับเงิน','icon' => 'money', 'url' => ['/receipt']],
                        ['label' => 'ตั้งค่าระบบ','icon' => 'gear', 'url' => ['/company']],
                        ['label' => 'ผู้ใช้งาน','icon' => 'user', 'url' => ['/users']],
                        [
                            'label' => 'ออกจากระบบ',
                            'icon' => 'power-off',
                            'url' => ['/site/logout'],
                            'template' => '<a href="{url}" data-method="post">{icon} {label}</a>'
                        ],
                    ],
                ]
        )
        ?>
        
    </section>

</aside>
