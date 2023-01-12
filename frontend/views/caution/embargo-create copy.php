<?php

use yii\helpers\Html;
use common\models\control\InstructionUser;
use yii\helpers\ArrayHelper;
use frontend\widgets\StepsPrevention;
use common\models\User;
use kartik\date\DatePicker;
use yii\widgets\ActiveForm;
use common\models\prevention\Embargo;
use common\models\control\Instruction;
use common\models\control\Company;
use kartik\select2\Select2;

/** @var yii\web\View $this */
/** @var common\models\prevention\Prevention $model */
$this->title = Yii::t('app', 'Taqiqlash');
?>
<div class="page1-1 row">
    <!--div class="col-sm-3">
     <?= StepsPrevention::widget([
                    
    ]) ?>
    </div-->
    
       <?php 
     
        //$companies=ArrayHelper::map($companies,'id','name');?>
       
                   
                    <?php $form = ActiveForm::begin(); ?>
                    <?= $form->field($model, 'instructions_id')->dropdownList([                           
                        $company->control_instruction_id => $company->controlInstruction->command_number
                           
                        ]
                    );?>
                    
                    <?= $form->field($model, 'companies_id')->dropdownList([                           
                         $company->id => $company->name
                           
                        ]
                    );?>
                    <?= $form->field($model, 'comment')->textarea(['rows' => '6']) ?>
                   
                    <!--?= $form->field($model, 'inspector_name')->textInput() ?-->
                     <?= $form->field($model, 'created_by')->dropdownList([                           
                           User::findOne(Yii::$app->user->id)->id => User::findOne(Yii::$app->user->id)->name . ' ' . User::findOne(Yii::$app->user->id)->surname
                          
                          ]);?>
                    
                    <div class="form-group">
                        <?= Html::submitButton(Yii::t('app', 'Saqlash'), ['class' => 'btn btn-success']) ?>
                    </div>
            <?php ActiveForm::end(); ?>            
            
            
        
    
    
    
     </div>
     
    


