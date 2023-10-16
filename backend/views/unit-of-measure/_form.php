<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\UnitOfMeasure $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="unit-of-measure-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'synonym')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kind_of_quantity')->textInput() ?>

    <?= $form->field($model, 'concept_eng')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dimension')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
