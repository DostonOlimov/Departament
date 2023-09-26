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


<div class="order-form container">


    
    <?php $form = ActiveForm::begin(); ?>
    <div class="order-form row">

    <div class="col-sm-6">
        <?= $form->field($model, 'gov_control_program_id')->textInput(['readonly' => true]) ?>
    </div>
    <div class="col-sm-6">
        </div>
    <div class="col-sm-6">
        <?= $form->field($model, 'control_period_from')->widget(DatePicker::class,$date_pluginOptions) ?>
    </div>
    <div class="col-sm-6">
        <?= $form->field($model, 'control_period_to')->widget(DatePicker::class,$date_pluginOptions) ?>
    </div>
    <div class="col-sm-6">
        <?= $form->field($model, 'control_date_from')->widget(DatePicker::class,$date_pluginOptions) ?>
    </div>
    <div class="col-sm-6">
        <?= $form->field($model, 'control_date_to')->widget(DatePicker::class,$date_pluginOptions) ?>
    </div>
<?php if($program->gov_control_type === $model::DN) : ?>
    <div class="col-sm-6">
        <?= $form->field($model, 'ombudsman_code_date')->widget(DatePicker::class,$date_pluginOptions) ?>
    </div>
    <div class="col-sm-6">
        <?= $form->field($model, 'ombudsman_code_number')->widget(MaskedInput::class, ['mask' => '999-999-999']) ?>
    </div>
<?php endif ?>

    <div class="col-sm-6">
    <?= $form->field($model, 'control_days_number')->textInput() ?>
</div>
    <div class="col-sm-6">
    <?= $form->field($model, "executors")->widget(Select2::class,[
            'data' => $model->users,
            'language' => 'uz',
            'options' => ['multiple' => true],
            'showToggleAll' => false,
        ]) ?>
    </div>





    <div class="form-group">
        <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success']) ?>
    </div>

</div>
    <?php ActiveForm::end(); ?>


</div>