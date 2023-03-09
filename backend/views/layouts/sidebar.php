<?php

use backend\widgets\Menu;
use common\models\User;

?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?=\yii\helpers\Url::home()?>" class="brand-link">
        <img src="<?= $assetDir ?>/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">Departament</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= $assetDir ?>/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?= User::findOne(Yii::$app->user->id)->name.' '.User::findOne(Yii::$app->user->id)->surname ?></a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <!-- href be escaped -->
        <!-- <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div> -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <?php
            $items = [
                
                ['label' => 'Davlat nazorati', 'url' => ['control/control/index'], 'icon' => 'fa fa-briefcase'],
                ['label' => 'Profilaktika', 'url' => ['profilactic/profilactic/index'], 'icon' => 'fa fa-address-book'],
                ['label' => 'Nazorat xaridi', 'url' => ['shopping/shopping/index'], 'icon' => 'fa fa-university'],
                ['label' => 'Iqtisodiy jarimalar', 'url' => ['measure/economic/index'], 'icon' => 'fa fa-percent'],
                ['label' => 'Ma\'muriy bayonnomalar', 'url' => ['measure/execution/index'], 'icon' => 'fa fa-credit-card'],
                ['label' => 'Tashkilotlar ro\'yxati', 'url' => ['company/index'], 'iconType' => 'far'],
                // ['label' => 'Berilgan ko\'rsatma va ogohlantirishlar', 'url' => ['caution/caution/index'], 'icon' => 'fa fa-building'],
                [
                    'label' => 'Berilgan ko\'rsatma va ogohlantirishlar',
                    'icon' => 'fa fa-exclamation-circle',
                    
                    //                        'badge' => '<span class="right badge badge-info">2</span>',
                    'items' => [
                        ['label' => 'Ko\'rsatma', 'url' => ['#'], 'iconStyle' => 'far',
                        'items' => [
                            ['label' => 'Bartaraf etish ko\'rsatmasi', 'url' => ['caution/prevention/index'], 'iconStyle' => 'far'],
                            ['label' => 'Taqiqlash ko\'rsatmasi', 'url' => ['caution/embargo/index'], 'iconStyle' => 'far'],
                            
                            ]
                            
                        ],
                        ['label' => 'Ogohlantirish xati', 'url' => ['caution/letters/index'], 'iconStyle' => 'far'],
                        
                    ],
                ], 
                
                ['label'=>'Sozlamalar', 'url' => ['#'], 'iconStyle' => 'fa fa-cog',
                'items'=>[
                    ['label' => 'Foydalanuvchilar', 'url' => ['user/index'], 'icon' => 'fa fa-users'],
                    ['label'=>'Hudud', 'url' => ['#'], 'iconStyle' => 'fa fa-map-marker',
                    'items'=>[
                        ['label' => 'Davlatlar', 'url' => ['country/index'], 'icon' => 'fas fa-globe'],
                        ['label' => 'Hududlar', 'url' => ['region/index'], 'icon' => 'far'],
                        ['label' => 'Hududiy sudlar', 'url' => ['court/index'], 'icon' => 'far'],
                        ['label' => 'Hududiy sudlar ro\'yxati', 'url' => ['measure/courts-name/index'], 'iconStyle' => 'far'],
                        ],
                    ],
                ['label'=>'Me\'yoriy hujjat', 'url' => ['#'], 'iconStyle' => 'far',
                    'items'=>[
                        ['label' => 'Mahsulot normativ hujjatlari', 'url' => ['nd/index'], 'icon' => 'far'],
                        ['label' => 'Normativ hujjat toifalari', 'url' => ['nd-type/index'], 'icon' => 'far'],
                        ['label' => 'Xavf tahlili mezonlari', 'url' => ['risk-analisys-criteria/index'], 'icon' => 'far'],

                    ],
                ],
                    //['label' => 'Dastur turi', 'url' => ['profilactic/program-type/index'], 'iconStyle' => 'far'],
                    ['label' => 'Soha nomi', 'url' => ['types/product-sector/index'], 'iconStyle' => 'far'],
                    ['label' => 'XYUS faoliyat turlari', 'url' => ['#'], 'iconStyle' => 'far'],
                    /// git
                    
                ],
            
        ],
            
            
            ];
        
            echo Menu::widget([
                'items' => $items,
            ]);
            ?>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>