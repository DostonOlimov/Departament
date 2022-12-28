<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/** @var yii\web\View $this */
/** @var common\models\prevention\Prevention $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="prevention-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'companies_id')->dropdownList([
        $model['companies_id'] => $model->company->name
    ]);?>

    <?= $form->field($model, 'instructions_id')->dropdownList([
        $model['instructions_id'] => $model->instruction->command_number
    ]);?>

    <?= $form->field($model, 'message_date')->widget(DatePicker::className()) ?>

    <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'inspector_name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
