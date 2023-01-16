<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $model Laboratory */


use common\models\control\Laboratory;
use frontend\widgets\Steps;
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

    <?= Steps::widget([
        'control_instruction_id' => $model->controlCompany->controlInstruction->id,
        'control_company_id' => $model->control_company_id,
    ]) ?>

    <?php $form = ActiveForm::begin() ;
    
    ?>
    <table>
        <tr><td class = "label">Na'muna olish dalolatnomasi</td><td> <?= $form->field($model, 'dalolatnoma')->fileInput()->label(false) ?></td></tr>
        <tr><td class = "label">Sinov bayonnomasi</td><td> <?= $form->field($model, 'bayonnoma')->fileInput()->label(false) ?></td></tr>
        <tr><td class = "label">Tashqi ko'rinish bayonnomasi</td><td> <?= $form->field($model, 'out_bayonnoma')->fileInput()->label(false) ?></td></tr>
        <tr><td class = "label">Oraliq dalolatnoma</td><td> <?= $form->field($model, 'out_dalolatnoma')->fileInput()->label(false) ?></td></tr>
        <tr><td class = "label">Yakuniy dalolatnoma</td><td> <?= $form->field($model, 'finish_dalolatnoma')->fileInput()->label(false) ?></td></tr>
    </table>

    <div class="col-md-6 col-lg-8">
        <?= $form->field($model, "comment")->textarea() ?>
    </div> 
    <div class="col-12" style="margin-top:10px;">
        <input type="submit" class="btn btn-info br-btn" value="Saqlash">
    </div>
    <?php ActiveForm::end() ?>

</div>
