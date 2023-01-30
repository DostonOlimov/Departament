<?php 
use yii\helpers\Html;
use yii\helpers\Url;?>


<div class="list-group margin-topSite">
    <a href="javascript:void(0);" class="list-group-item list-group-item-action notHover">Reestr</a>
    <a href="<?= Url::to(['/caution/instruction-file']) ?>" class="list-group-item list-group-item-action actived">Davlat nazorat buyruqlari</a>
    <a href="<?= Url::to(['/caution/letters']) ?>" class="list-group-item list-group-item-action actived">Ogohlantirish xatlari</a>
    <a href="#" class="list-group-item list-group-item-action actived" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">Ko'rsatmalar</a>
        <div class="dropdown-menu">
            <a class="dropdown-item list-group-item list-group-item-action actived" href="<?= Url::to(['/caution/prevention']) ?>">Bartaraf etish ko'rsatmasi</a>
            <a class="dropdown-item list-group-item list-group-item-action actived" href="<?= Url::to(['/caution/embargo']) ?>">Taqiqlash ko'rsatmasi</a>
        </div>
    <a href="#" class="list-group-item list-group-item-action actived" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">Choralar</a>
    <div class="dropdown-menu">
        <a class="dropdown-item list-group-item list-group-item-action actived" href="<?= Url::to(['/measure/ov-index']) ?>">O'lchov vositasini taqiqlash</a>
        <a class="dropdown-item list-group-item list-group-item-action actived" href="<?= Url::to(['/measure/realization-index']) ?>">Realizatsiyani taqiqlash</a>
        <a class="dropdown-item list-group-item list-group-item-action actived" href="<?= Url::to(['/measure/economic-index']) ?>">Iqtisodiy jarima</a>
        <a class="dropdown-item list-group-item list-group-item-action actived" href="<?= Url::to(['/measure/execution-index']) ?>">Ma'muriy bayonnoma</a>
    </div>
</div>
        