<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\measure\Executions $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="executions-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'control_instruction_id')->textInput() ?>

    <?= $form->field($model, 'person')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'number_passport')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fine_amount')->textInput() ?>

    <?= $form->field($model, 'paid_amount')->textInput() ?>

    <?= $form->field($model, 'band_mjtk')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'explanation_letter')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'claim')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'court_letter')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'person_position')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'first_date')->textInput() ?>

    <?= $form->field($model, 'caution_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
