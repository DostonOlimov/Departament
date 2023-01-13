<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\measure\Economics $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="economics-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'control_instruction_id')->textInput()->hiddenInput()->label(false); ?>

    <?= $form->field($model, 'first_warn_date')->textInput() ?>

    <?= $form->field($model, 'warn_number')->textInput() ?>

    <?= $form->field($model, 'eco_date')->textInput() ?>

    <?= $form->field($model, 'eco_number')->textInput() ?>

    <?= $form->field($model, 'eco_quantity')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'eco_amount')->textInput(['maxlength' => true]) ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
