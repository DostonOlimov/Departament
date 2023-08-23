<?php 
use yii\helpers\Html;
use yii\helpers\Url;?>


<div class="list-group margin-topSite">
    <a href="javascript:void(0);" class="list-group-item list-group-item-action notHover">Reestr</a>
    <a href="<?= Url::to(['/company/index']) ?>" class="list-group-item list-group-item-action actived">Tashkilotlar ro'yxati</a>
    <a href="<?= Url::to(['/caution/letters']) ?>" class="list-group-item list-group-item-action deactived">Ogohlantirish xatlari</a>
    <a href="<?= Url::to(['/caution/instruction-file']) ?>" class="list-group-item list-group-item-action deactived">Xabarnomalar</a>
    <a href="<?= Url::to(['/govcontrol/program/index']) ?>" class="list-group-item list-group-item-action actived">Davlat nazorat dasturlari</a>
    <a href="#" class="list-group-item list-group-item-action deactived" 
    type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">Ko'rsatmalar</a>
        
        <div class="dropdown-menu">
            <a class="dropdown-item list-group-item list-group-item-action actived" href="<?= Url::to(['/caution/prevention']) ?>">Bartaraf etish ko'rsatmasi</a>
            <a class="dropdown-item list-group-item list-group-item-action actived" href="<?= Url::to(['/caution/embargo']) ?>">Taqiqlash ko'rsatmasi</a>
        </div>

    <a href="#" class="list-group-item list-group-item-action deactived" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">Choralar</a>
    <div class="dropdown-menu">
        <a class="dropdown-item list-group-item list-group-item-action deactived" href="<?= Url::to(['']) ?>">O'lchov vositasini taqiqlash</a>
        <a class="dropdown-item list-group-item list-group-item-action deactived" href="<?= Url::to(['']) ?>">Realizatsiyani taqiqlash</a>
        <a class="dropdown-item list-group-item list-group-item-action deactived" href="<?= Url::to(['']) ?>">Iqtisodiy jarima</a>
        <a class="dropdown-item list-group-item list-group-item-action deactived" href="<?= Url::to(['']) ?>">Ma'muriy bayonnoma</a>
    </div>
</div>
        