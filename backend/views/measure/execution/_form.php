<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\measure\Executions $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="executions-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'control_instruction_id')->hiddenInput()->label(false); ?>

    <?= $form->field($model, 'person')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'number_passport')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fine_amount')->textInput() ?>

    <?= $form->field($model, 'paid_amount')->textInput() ?>

    <?= $form->field($model, 'person_position')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'caution_number')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
