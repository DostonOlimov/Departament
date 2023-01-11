<?php

use yii\helpers\Html;
use common\models\control\InstructionUser;
use yii\helpers\ArrayHelper;
use frontend\widgets\StepsPrevention;
use common\models\User;
use kartik\date\DatePicker;
use kartik\file\FileInput;
use yii\widgets\ActiveForm;
use common\models\control\Instruction;
use common\models\control\Company;
//use kartik\select2\Select2;

/** @var yii\web\View $this */
/** @var common\models\prevention\Prevention $model */
$this->title = Yii::t('app', 'Taqiqlash');
?>
<div class="page1-1 row">
    <!--div class="col-sm-3">
     <?= StepsPrevention::widget([
                    
    ]) ?>
    </div-->
   
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'company_id')->dropdownList([                           
         $company->id => $company->name]);?>
    <?= $form->field($model, 'instructions_id')->dropdownList([                           
        $company->control_instruction_id => $company->controlInstruction->command_number]);?>
    <div class="row">
        <div class="form-group col-sm-6">
        <?= $form->field($model, 'comment')->textarea(['rows' => '6']) ?>
         <?= $form->field($model, 'letter_date')->widget(DatePicker::className()) ?>
         <?= $form->field($model, 'letter_number')->widget(\yii\widgets\MaskedInput::className(), [
                'mask' => '99-999']) ?>
       <?= $form->field($model, 'created_by')->dropdownList([                           
            User::findOne(Yii::$app->user->id)->id => User::findOne(Yii::$app->user->id)->name . ' ' . User::findOne(Yii::$app->user->id)->surname
            
            ]);?>
        </div>
        <div class="form-group col-sm-6">
        <?= $form->field($model, 'file')->widget(FileInput::className(),[
            'options'=>['accept'=>'pdf/*','doc/*','docx/*'],
            'pluginOptions' => [
                'showUpload' => false,
            // 'uploadUrl' => Url::to(['/site/upload']),
                'allowFileExtensions' => ['pdf','jpeg'],
                'maxFileSize' => 3000
            ],
            ])?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?> 
    
     </div>
     
    


