<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/** @var yii\web\View $this */
/** @var common\models\RiskAnalisys $model */
/** @var yii\widgets\ActiveForm $form */
?>
   <?php $form = ActiveForm::begin(); ?>
<?php foreach ( $model as $key => $value) :  ?>
 

    <?= $form->field($value, "[{$key}]risk_analisys_id")->hiddenInput(['value' => $value->risk_analisys_id])->label(false) ?>
    
    <?= $form->field($value, "[{$key}]criteria_id")->hiddenInput(['value' => $value->criteria_id])->label(false) ?>

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
<?php ActiveForm::end(); ?>

