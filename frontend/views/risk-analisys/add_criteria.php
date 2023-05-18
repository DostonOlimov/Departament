<?php

use common\models\Company;
use common\models\RiskAnalisys;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;
use frontend\widgets\StepsRiskAnalisys;

$form = ActiveForm::begin(); ?>
   <div class="row">
   <div class="col-3 mt-5">
        <?php 
        $company_id = RiskAnalisys::findOne(['id' => $model[0]->risk_analisys_id])->company_id;
        
        echo StepsRiskAnalisys::widget([
          'company_id' => $company_id,
          'id' => $model[0]->risk_analisys_id,
          'view_id' => null,
        ])?>
    </div>
    <div class="col-6 mt-5">
    
<?php foreach ( $model as $key => $value) :  ?>

    <?= $form->field($value, "[{$key}]risk_analisys_id")->HiddenInput(['value' => $value->risk_analisys_id])->label(false) ?>
    
    <?= $form->field($value, "[{$key}]criteria_id")->HiddenInput(['value' => $value->criteria_id])->label(false) ?>

    <?= $form->field($value, "[{$key}]status")->checkbox([
  'label' => $value->name,
  'checked' => false,
  'uncheck' => 0,
    ]); ?>
   
    <?= $form->field($value, "[{$key}]comment")->textInput() ?>
   
<?php endforeach; ?>
<div class="form-group">
<?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
</div>
</div>
</div>
<?php ActiveForm::end(); ?>