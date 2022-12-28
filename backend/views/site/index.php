<?php

use common\models\User;
use backend\widgets\Alert;
use backend\widgets\Callout;
use backend\widgets\InfoBox;
use backend\widgets\Ribbon;
use backend\widgets\SmallBox;

$this->title = 'Statistika';
$this->params['breadcrumbs'] = [['label' => $this->title]];
?>
<div class="container-fluid" > 
    <div class="row">
        <div class="col-lg-6">
        <?php $full_name = User::findOne(Yii::$app->user->id)->name.' '. User::findOne(Yii::$app->user->id)->surname ?>
            <?php echo  Alert::widget([
                'type' => 'success',
                'body' => "<h3>Admin $full_name <br>
                Tizimga muvaffaqiyatli kirildi!</h3>",
                
            ]) ?>
        </div>
           <div class="col-lg-12"> 
            <?= Callout::widget([
                'type' => 'danger',
                'head' => 'Davlat nazorat departamentining statistika sahifasi!',
                'body' => 'Bu sahifadagi malumotlarni o\'zgartirish huquqi faqat departamentning tayinlangan xodimlariga berilgan'
            ]) ?>
           </div>
    </div>

    <div class="row">
        <div class="col-md-4 col-sm-6 col-12">
            <?= InfoBox::widget([
                'text' => 'Messages',
                'number' => '1,410',
                'icon' => 'far fa-envelope',
            ]) ?>
        </div>
        <div class="col-md-4 col-sm-6 col-12">
            <?= InfoBox::widget([
                'text' => 'Bookmarks',
                'number' => '410',
                 'theme' => 'success',
                'icon' => 'far fa-flag',
            ]) ?>
        </div>
        <div class="col-md-4 col-sm-6 col-12">
            <?= InfoBox::widget([
                'text' => 'Uploads',
                'number' => '13,648',
                'theme' => 'gradient-warning',
                'icon' => 'far fa-copy',
            ]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 col-sm-6 col-12">
            <?= InfoBox::widget([
                'text' => 'Bookmarks',
                'number' => '41,410',
                'icon' => 'far fa-bookmark',
                'progress' => [
                    'width' => '70%',
                    'description' => '70% Increase in 30 Days'
                ]
            ]) ?>
        </div>
        <div class="col-md-4 col-sm-6 col-12" >
            <?php $infoBox = InfoBox::begin([
                'text' => 'Likes',
                'number' => '41,410',
                'theme' => 'success',
                'icon' => 'far fa-thumbs-up',
                'progress' => [
                    'width' => '70%',
                    'description' => '70% Increase in 30 Days'
                ]
            ]) ?>
            <?= Ribbon::widget([
                'id' => $infoBox->id.'-ribbon',
                'text' => 'Ribbon',
            ]) ?>
            <?php InfoBox::end() ?>
        </div>
        <div class="col-md-4 col-sm-6 col-12">
            <?= InfoBox::widget([
                'text' => 'Events',
                'number' => '41,410',
                'theme' => 'gradient-warning',
                'icon' => 'far fa-calendar-alt',
                'progress' => [
                    'width' => '70%',
                    'description' => '70% Increase in 30 Days'
                ],
                'loadingStyle' => true
            ]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <?= SmallBox::widget([
                'title' => '150',
                'text' => 'New Orders',
                'icon' => 'fas fa-shopping-cart',
            ]) ?>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <?php $smallBox = SmallBox::begin([
                'title' => '150',
                'text' => 'New Orders',
                'icon' => 'fas fa-shopping-cart',
                'theme' => 'success'
            ]) ?>
            <?= Ribbon::widget([
                'id' => $smallBox->id.'-ribbon',
                'text' => 'Ribbon',
                'theme' => 'warning',
                'size' => 'lg',
                'textSize' => 'lg'
            ]) ?>
            <?php SmallBox::end() ?>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <?= SmallBox::widget([
                'title' => '44',
                'text' => 'User Registrations',
                'icon' => 'fas fa-user-plus',
                'theme' => 'gradient-success',
                'loadingStyle' => true
            ]) ?>
        </div>
    </div>
</div>