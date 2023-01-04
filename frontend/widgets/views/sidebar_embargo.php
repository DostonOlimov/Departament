<?php 
use yii\helpers\Html;
use yii\helpers\Url;?>

<div class="  list-group margin-top">
    <a href="javascript:void(0);" class="list-group-item list-group-item-action  notHover">Ko'rsatma</a>
    <a href="<?= Url::to(['/caution/prevention']) ?>" class="list-group-item list-group-item-action">Bartaraf etish ko'rsatmasi</a>
    <a href="<?= Url::to(['/caution/embargo']) ?>" class="list-group-item list-group-item-action active">Taqiqlash ko'rsatmasi</a>
    
    
</div>