<?php

use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\identification\LaboratoryProtocol $model */
/** @var yii\widgets\ActiveForm $form */
$date_pluginOptions =['pluginOptions' => ['autoclose' => true,'format' => 'dd.mm.yyyy']];
?>

<div class="laboratory-protocol-form container">
<div class="row">
    
    <div class="col-sm-6">
        <?= $form->field($model, 'selected_product_id')->textInput() ?>
    </div>
    <div class="col-sm-6">
        <?= $form->field($model, 'status')->textInput() ?>
    </div>
</div><!-- .row -->

<div class="row">
    <div class="col-sm-6">
        <?= $form->field($model, 'laboratory_id')->textInput() ?>
    </div>
    <div class="col-sm-6">
        <?= $form->field($model, 'delivery_date')->widget(DatePicker::class,$date_pluginOptions) ?>
    </div>
</div><!-- .row -->

<div class="row">
    <div class="col-sm-6">
        <?= $form->field($model, 'protocol_number')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-sm-6">
        <?= $form->field($model, 'protocol_date')->widget(DatePicker::class,$date_pluginOptions) ?>
    </div> 
</div><!-- .row -->

    <?php 
    // echo $form->field($model, 'created_at')->textInput() ?>

    <?php
    // echo $form->field($model, 'updated_at')->textInput() ?>

    <?php 
    // echo $form->field($model, 'created_by')->textInput() ?>

    <?php
    // echo $form->field($model, 'updated_by')->textInput() ?>

</div>
