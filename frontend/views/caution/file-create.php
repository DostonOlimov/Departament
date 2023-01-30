<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $model Laboratory */


use common\models\control\InstructionFile;
use common\models\User;
use frontend\widgets\StepsReestr;
use kartik\file\FileInput;
use yii\widgets\ActiveForm;

$this->title = 'Na`muna olish va labaratoriya natijalari';
$this->params['breadcrumbs'][] = $this->title;

?>
<style>
    .label{
        font-size: 25px;
        color:black;
        padding:15px;
        width:540px;
    }
</style>
<div class="page1-1 row">
    <div class="col-3">
        <?= StepsReestr::widget([
        
        ]) ?>
    </div>

    <?php $form = ActiveForm::begin() ;
    
    ?>
    <table>
        <tr><td class = "label">Asos xati</td><td> <?= $form->field($model, 'basis_file')->fileInput()->label(false) ?></td></tr>
        <tr><td class = "label">Dastur xati</td><td> <?= $form->field($model, 'program_file')->fileInput()->label(false) ?></td></tr>
        <tr><td class = "label">Buyruq xati</td><td> <?= $form->field($model, 'order_file')->fileInput()->label(false) ?></td></tr>
    </table>

    <div class="col-md-6 col-lg-8">
    <?= $form->field($model, 'instructions_id')->dropdownList([
        $model['instructions_id'] => $model->instruction->command_number
    ]);?>
    <?= $form->field($model, 'created_by')->dropdownList([
        User::findOne(Yii::$app->user->id)->id => User::findOne(Yii::$app->user->id)->name . ' ' . User::findOne(Yii::$app->user->id)->surname
    ]);?>
    <?= $form->field($model, 'updated_by')->dropdownList([
        User::findOne(Yii::$app->user->id)->id => User::findOne(Yii::$app->user->id)->name . ' ' . User::findOne(Yii::$app->user->id)->surname
    ]);?>
   
    </div> 
    <div class="col-12" style="margin-top:10px;">
        <input type="submit" class="btn btn-info br-btn" value="Saqlash">
    </div>
    <?php ActiveForm::end() ?>

</div>
