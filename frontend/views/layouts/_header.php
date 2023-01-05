<?php

use common\models\User;
use yii\helpers\Html;
use yii\helpers\Url;?>
<div class="prof-nav">
    <a href="/">
        <div class="box1 box">
            <img  src="/pics/gerb-1.png" alt="Ozbekiston gerbi">
            <h5>Davlat nazorat departamenti</h5>
        </div>
    </a>
    <div class="box2 box">
        <div class="box3">
            <i class="fas fa-user-tie fa-2x"></i>
            <h5>
                <?= Yii::$app->user->id ? User::findOne(Yii::$app->user->id)->username : 'Inspektor F.I.О' ?>
            </h5>
            <button class="btn btn btn-danger logOut"><?= Html::a(
                    'Chiqish',
                    ['/site/logout'],
                    ['data-method' => 'post',]
                ) ?>
                <i style="display: inline-block" class="fas fa-sign-out-alt ml-2"></i>
            </button>
        </div>
    </div>
</div>
<!-- ......................................................... -->

<!-- .....................NAVBAR MENU..................... -->


<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid ">

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav nav-menu">
                <li class="nav-item">
                    <button class="btn btn-none text-white btn-drop" type="button">
                        <a href="<?= Url::to(['/control/index']) ?>">Davlat nazorati</a>
                    </button>
                </li>
                <li class="nav-item">
                    <button class="btn btn-none text-white btn-drop" type="button" >
                        <a href="<?= Url::to(['/profilactic/index']) ?>">Profilaktika</a>
                    </button>
                </li>
                <li class="nav-item">
                    <button class="btn btn-none  text-white btn-drop" onclick="changeColor(event, 'btn3')" id ="btn3" type="button" >
                        <a href="<?= Url::to(['/shopping/index']) ?>">  Nazorat haridi</a>
                    </button>
                </li>
                <li class="nav-item">
                    <button class="btn btn-none  text-white btn-drop" onclick="changeColor(event, 'btn3')" id ="btn3" type="button" >
                        <a href="<?= Url::to(['/caution/reestr']) ?>">  Reestr</a>
                    </button>
                </li>
                <li class="nav-item">
                    <!-- <button class="btn btn-none  textw-white btn-drop" onclick="btn_change()" id = "btn4" type="button" >
                        <a href="">Berilgan ko'rsatma va ogohlantirishlar</a>
                    </button> -->
                    <div class="dropdown">
                        <a class="btn btn-none  text-white btn-drop dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                        Berilgan ko'rsatma va ogohlantirishlar  
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <li><a class="dropdown-item" href="<?= Url::to(['/caution/prevention']) ?>">Ko'rsatma</a></li>
                            <li><a class="dropdown-item" href="#">Ogohlantirish</a></li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <button class="btn btn-none  text-white btn-drop" type="button">
                        <a href="http://control.standart.uz/">Havfli maxsulotlar reestri</a>
                    </button>
                </li>

            </ul>
        </div>
    </div>
</nav>


<script>

    function post() {
        const url = "http://example.com";
        fetch(url, {
            method : "POST",
            body: new FormData(document.getElementById("selectForm").value),
        }).then(
            response => response.text()
        ).then(
            html => console.log(html)
        );
    }

</script>