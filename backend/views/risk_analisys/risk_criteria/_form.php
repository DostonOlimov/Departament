<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\RisksCriteria $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="risks-criteria-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'risk_analisys_id')->textInput() ?>

    <?= $form->field($model, 'criteria_id')->textInput() ?>

    <?= $form->field($model, 'comment')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
