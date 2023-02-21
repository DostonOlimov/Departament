<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\control\InstructionType $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="instruction-type-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'instruction_id')->textInput() ?>

    <?= $form->field($model, 'product')->textInput() ?>

    <?= $form->field($model, 'ov')->textInput() ?>

    <?= $form->field($model, 'document')->textInput() ?>

    <?= $form->field($model, 'canceled')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
