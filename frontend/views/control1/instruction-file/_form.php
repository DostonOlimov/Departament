<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\control\InstructionFile $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="instruction-file-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'instructions_id')->textInput() ?>

    <?= $form->field($model, 'basis_file')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'program_file')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'order_file')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
