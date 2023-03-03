<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

/** @var yii\web\View $this */
/** @var common\models\RiskAnalisysCriteria $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="risk-analisys-criteria-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'document_paragraph')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'criteria_category')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'criteria')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'company_field_category')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'criteria_score')->widget(MaskedInput::className(), ['mask' => '99']) ?>

    <div class="form-group">
        <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
