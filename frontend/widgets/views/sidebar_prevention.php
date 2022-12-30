<?php 
use yii\helpers\Html;
use yii\helpers\Url;
?>
<div class="  list-group margin-top">
    <a href="javascript:void(0);" class="list-group-item list-group-item-action  notHover">Ko'rsatma</a>
    <a href="<?= Url::to(['/prevention/index']) ?>" class="list-group-item list-group-item-action active ">Bartaraf etish ko'rsatmasi</a>
    <a href="<?= Url::to(['/embargo/index']) ?>" class="list-group-item list-group-item-action">Taqiqlash ko'rsatmasi</a>
    
    
</div>