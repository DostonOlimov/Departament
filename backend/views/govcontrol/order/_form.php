<?php

use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

/** @var yii\web\View $this */
/** @var common\models\govcontrol\Order $model */
/** @var yii\widgets\ActiveForm $form */
$date_pluginOptions =['pluginOptions' => ['autoclose' => true,'format' => 'dd.mm.yyyy']];
?>

<div class="order-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'gov_control_program_id')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'order_prefix')->dropDownList($model->getGovControlPrefix(), ['prompt' => '']) ?>

    <?= $form->field($model, 'order_number')->textInput() ?>

    <?= $form->field($model, 'control_period_from')->widget(DatePicker::class,$date_pluginOptions) ?>

    <?= $form->field($model, 'control_period_to')->widget(DatePicker::class,$date_pluginOptions) ?>

    <?= $form->field($model, 'control_date_from')->widget(DatePicker::class,$date_pluginOptions) ?>

    <?= $form->field($model, 'control_date_to')->widget(DatePicker::class,$date_pluginOptions) ?>

    <?= $form->field($model, 'ombudsman_code_date')->widget(DatePicker::class,$date_pluginOptions) ?>

    <?= $form->field($model, 'ombudsman_code_number')->widget(MaskedInput::class, ['mask' => '999-999-999']) ?>

    <?= $form->field($model, 'status')->dropDownList($model->getDocumentStatus()) ?>

    <?= $form->field($model, 'control_days_number')->textInput() ?>

    <?= $form->field($model, "executors")->widget(Select2::class,[
            'data' => $model->users,
            'language' => 'uz',
            'options' => ['multiple' => true],
            'showToggleAll' => false,
        ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
