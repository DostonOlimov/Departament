<?php

use yii\helpers\Html;
use common\models\control\InstructionUser;
use yii\helpers\ArrayHelper;
use frontend\widgets\StepsPrevention;
use common\models\User;
use kartik\date\DatePicker;
use yii\widgets\ActiveForm;
use common\models\prevention\Prevention;
use common\models\control\Instruction;
use common\models\control\Company;
use kartik\select2\Select2;
use wbraganca\dynamicform\DynamicFormWidget;

/** @var yii\web\View $this */
/** @var common\models\prevention\Prevention $model */
$this->title = Yii::t('app', 'Bartaraf_etish');
?>
<div class="page1-1 row">
    <!--div class="col-sm-3">
     <?= StepsPrevention::widget([
                    
    ]) ?>
    </div-->
          
        <?php $form = ActiveForm::begin([
            'id' => 'dynamic-form',
            'enableClientValidation' => false,
            'options' => [
                'enctype' => 'multipart/form-data',
            ]
        ]) ?>
    
            <i class="fa fa-toggle-right" id = "open2" onclick=openPanel2(); style="font-size:24px;color:blue;display:none;"></i> 
            <i class="fa fa-toggle-down " id = "close2" onclick=closePanel2(); style="font-size:24px;color:blue; " ></i> 
            <h3 style="color:black;display:inline;">Bartaraf etish ko'rsatmasi</h3>
                <hr>
        <div class="row" id="content2"  >
            <div class="box box-default" style="display: inline-block">
                <div class="panel-body">
                    <?php DynamicFormWidget::begin([
                        'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                        'widgetBody' => '.container-items', // required: css class selector
                        'widgetItem' => '.item', // required: css class
//                        'limit' => 7, // the maximum times, an element can be cloned (default 999)
                        'min' => 1, // 0 or 1 (default 1)
                        'insertButton' => '.add-item', // css class
                        'deleteButton' => '.remove-item', // css class
                        'model' => $model,
                        'formId' => 'dynamic-form',
                        'formFields' => [
                            'type',
                            'measurement',
                            'compared',
                            'invalid',

                        ],
                    ]); ?>
                <div class="container-items">        
                        <!--?php
                        foreach ($model as $i => $item):
                            if ($i == 1) {
                                continue;
                            } ?-->
                           
                            <div class="item panel panel-default item-product itemlar"  >
                                <div class="panel-heading" >
                 
                                    <div class="pull-right">
                                        <button type="button" class="add-item btn btn-success btn-xs">
                                            <i class="fa fa-plus"></i></button>
                                        <button type="button" class="remove-item btn btn-danger btn-xs" id="removeBtn">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="panel-body">
                                    <div class="row ">
                                        <div class="col-sm-4">
                                        <?= $form->field($model, 'instructions_id')->dropdownList([                           
                                            $company->control_instruction_id => $company->controlInstruction->command_number
                                            
                                            ]
                                        );?>
                                        </div>
                                        <div class="col-sm-4">
                                        <?= $form->field($model, 'companies_id')->dropdownList([                           
                                            $company->id => $company->name
                                            
                                            ]
                                        );?>
                                        </div>
                                        <div class="col-sm-4">
                                        <?= $form->field($model, 'created_by')->dropdownList([                           
                                        User::findOne(Yii::$app->user->id)->id => User::findOne(Yii::$app->user->id)->name . ' ' . User::findOne(Yii::$app->user->id)->surname
                                        
                                        ]);?>
                                        </div>
                                        <div class="col-sm-12">
                                        <?= $form->field($model, 'comment')->textarea(['rows' => '6']) ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                          
                    </div>
                    <?php DynamicFormWidget::end(); ?>
                    <div class="form-group">
                        <?= Html::submitButton(Yii::t('app', 'Saqlash'), ['class' => 'btn btn-success']) ?>
                    </div>
                    <?php ActiveForm::end() ?>
             
                            
        
    
    
    
     </div>
     
    


