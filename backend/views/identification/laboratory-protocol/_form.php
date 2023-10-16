<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\identification\LaboratoryProtocol $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="laboratory-protocol-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'selected_product_id')->textInput() ?>

    <?= $form->field($model, 'laboratory_id')->textInput() ?>

    <?= $form->field($model, 'delivery_date')->textInput() ?>

    <?= $form->field($model, 'protocol_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'protocol_date')->textInput() ?>

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
