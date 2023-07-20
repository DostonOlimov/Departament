<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\RiskAnalisys $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="risk-analisys-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'company_id')->textInput() ?>

    <?= $form->field($model, 'risk_analisys_date')->textInput() ?>

    <?= $form->field($model, 'risk_analisys_number')->textInput() ?>

    <?= $form->field($model, 'summary_user_id')->dropDownList($model->getUsers()) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

   
    <?php ActiveForm::end(); ?>

</div>
