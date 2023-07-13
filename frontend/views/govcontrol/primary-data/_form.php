<?php

use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\govcontrol\PrimaryData $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="primary-data-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'company_type_id')->dropDownList($model->getActivity()) ?>

    <?= $form->field($model, 'gov_control_order_id')->textInput() ?>

    <?= $form->field($model, 'real_control_date_from')->widget(DatePicker::class,['pluginOptions' => [
        'autoclose' => true,
        'format' => 'dd.mm.yyyy'
    ]]) ?>

    <?= $form->field($model, 'real_control_date_to')->widget(DatePicker::className(),['pluginOptions' => [
        'autoclose' => true,
        'format' => 'dd.mm.yyyy'
    ]]) ?>

    <?= $form->field($model, 'quality_management_system')->textInput() ?>

    <?= $form->field($model, 'product_exists')->textInput() ?>

    <?= $form->field($model, 'laboratory_exists')->textInput() ?>

    <?= $form->field($model, 'last_gov_control_date')->widget(DatePicker::className(),['pluginOptions' => [
        'autoclose' => true,
        'format' => 'dd.mm.yyyy'
    ]]) ?>

    <?= $form->field($model, 'last_gov_control_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
