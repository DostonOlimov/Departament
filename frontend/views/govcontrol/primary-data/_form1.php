<?php

use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\govcontrol\PrimaryData $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="primary-data-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, "company_type_id")->widget(Select2::class,[
            'data' => $model->getActivity(),
            'language' => 'uz',
            'options' => ['multiple' => false, 'prompt' => ''],
            // 'showToggleAll' => false,
            
        ]) ?>

    <?= $form->field($model, 'gov_control_order_id')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'real_control_date_from')->widget(DatePicker::class,['pluginOptions' => [
        'autoclose' => true,
        'format' => 'dd.mm.yyyy'
    ]]) ?>

    <?= $form->field($model, 'quality_management_system')->dropDownList($model->getObjectQMS(), ['prompt' => '']) ?>

    <?= $form->field($model, 'product_exists')->dropDownList($model->getObjectProduct(), ['prompt' => '']) ?>

    <?= $form->field($model, 'laboratory_exists')->dropDownList($model->getObjectLaboratory(), ['prompt' => '']) ?>

    <?= $form->field($model, 'measuring_and_testing_tools_exists')->dropDownList($model->getObjectMeasure(), ['prompt' => '']) ?>

    <?= $form->field($model, 'last_gov_control_date')->widget(DatePicker::className(),['pluginOptions' => [
        'autoclose' => true,
        'format' => 'dd.mm.yyyy'
    ]]) ?>

    <?= $form->field($model, 'last_gov_control_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
