<?php

use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\normativedocument\NormativeDocument $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="normative-document-form">
    <?php $form = ActiveForm::begin(); ?>
    
    <div class="row">
        <div class="col-9">
            <?= $form->field($model, 'name')->textarea(['rows' => 2]) ?>
        </div>
        <div class="col-3">
            <?= $form->field($model, 'status')->dropDownList($model->getDocumentStatus(), ['prompt' => '']) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <?= $form->field($model, 'category_id')->dropDownList($model->getNormativeDocumentType()) ?>
        </div>
        <div class="col-6">
                <?= $form->field($model, 'determination')->textInput(['maxlength' => true]) ?>
            </div>
        </div><!--end row-->
        
        <div class="row">
            <div class="col-6">
                <?= $form->field($model, 'activation_date')->widget(DatePicker::class,
            [
                'pluginOptions' => 
                [
                    'autoclose' => true,
                    'format' => 'dd.mm.yyyy'
                    ]
                    ]) ?>
        </div>
        <div class="col-6">
            <?= $form->field($model, 'deactivation_date')->widget(DatePicker::class,
            [
                'pluginOptions' => 
                [
                    'autoclose' => true,
                    'format' => 'dd.mm.yyyy'
                    ]
            ]) ?>
        </div>
    </div><!--end row-->
    
        <div class="row">
            <div class="col-6">
                <?= $form->field($model, 'activation_info')->textarea(['rows' => 6]) ?>
            </div>
            <div class="col-6">
                <?= $form->field($model, 'deactivation_info')->textarea(['rows' => 6]) ?>   
            </div>
        </div><!--end row-->
        <div class="row">
            <div class="col-6">
                </div>
        </div><!--end row-->
        <div class="row">
            <div class="col-6">
                </div>
            </div><!--end row-->
            
            
            
            
            
            
            
            <div class="form-group">
                <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success']) ?>
            </div>
            
            <?php ActiveForm::end(); ?>
            
        </div>
