<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\control\DocumentAnalysis $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="document-analysis-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'control_instruction_id')->textInput() ?>

    <?= $form->field($model, 'reestr_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'given_date')->textInput() ?>

    <?= $form->field($model, 'defect')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
