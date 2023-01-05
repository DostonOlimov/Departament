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

/** @var yii\web\View $this */
/** @var common\models\prevention\Prevention $model */
$this->title = Yii::t('app', 'Bartaraf_etish');
?>
<div class="page1-1 row">
    <!--div class="col-sm-3">
     <?= StepsPrevention::widget([
                    
    ]) ?>
    </div-->
    <form action="<?= \yii\helpers\Url::to(['prevention/create']) ?>" method="get">
    <label for="">Tekshiruv kodi</label>
        <input class="form-control" name="q" type="text" required minlength="5" maxlength="20" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Tekshiruv kodini kiriting...';}" required=""><br>
        <input class="btn btn-primary" type="submit" value="Qidiruv">

    </form>
       
 
    <?php if(!empty($codes)): ?>
       <?php 
     
        //$companies=ArrayHelper::map($companies,'id','name');?>
       
                    
                    <?php foreach($codes as $code): ?>
                     
                    <?php endforeach;?>
                   
                    <?php $form = ActiveForm::begin(); ?>
                    <?= $form->field($model, 'instructions_id')->dropdownList([                           
                         $code['id'] => $code['command_number']
                           
                        ]
                    );?>
                    
                    <?= $form->field($model, 'companies_id')->dropdownList([                           
                          $companies['id'] => $companies['name'],
                           
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
            <?php else: ?>
                <div class="row">
                <div class="alert alert-primary d-flex align-self-center align-items-center justify-content-md-center" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                </svg>
                <div>
                    <?php echo 'Tekshiruv kodi topilmadi';?>
                </div>
                </div>

            <?php endif; ?>
            
        
    
    
    
     </div>
     
    


