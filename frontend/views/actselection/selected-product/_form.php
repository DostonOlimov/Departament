<?php

use common\models\Countries;
use common\models\UnitOfMeasure;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;
// use PhpUnitsOfMeasure\PhysicalQuantity\UnitOfMeasure;
// use PhpUnitsOfMeasure\PhysicalQuantity\UnitOfMeasure;
use PhpUnitsOfMeasure\PhysicalQuantity\Length;
// use PhpUnitsOfMeasure\Unit;

/** @var yii\web\View $this */
/** @var common\models\actselection\SelectedProduct $model */
/** @var yii\widgets\ActiveForm $form */
?>
<?php
// Get the list of units for the Length quantity
// $units = Unit::getUnits(Length::class);
// Build a dropdown list with the units
?>

<div class="selected-product-form">
    
    <?php $form = ActiveForm::begin(); ?>
    
    <div class="row">
        <div class="col-sm-9">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, "act_selection_id")->textInput(['readonly' => true]) ?>
        </div>
    </div><!-- .row -->
    <div class="row">
        <div class="col-sm-3">
            <?= $form->field($model, 'batch_number')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'ctry_ogn_code')->dropDownList(ArrayHelper::map(Countries::find()->all(),'id', 'name' ), ['prompt' => '- - -']) ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'mfr_name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'mfr_id')->widget(MaskedInput::class, [
                'mask' => '999999999'
            ])?>
        </div>
    </div><!-- .row -->
    <div class="row">
        <div class="col-sm-3">
            <?= $form->field($model, 'mfrd_date')->widget(DatePicker::class,
    [
        'pluginOptions' => 
        [
            'autoclose' => true,
            'format' => 'dd.mm.yyyy'
            ]
            ]) ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'exptr_ctry_code')->dropDownList(ArrayHelper::map(Countries::find()->all(),'id', 'name' ), ['prompt' => '- - -']) ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'imptr_name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'imptr_id')->widget(MaskedInput::class, [
                'mask' => '999999999'
            ])?>
        </div>
    </div><!-- .row -->
    <div class="row">
        <div class="col-sm-3">
            <?= $form->field($model, 'prod_netto')->textInput() ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'xtra_value')->textInput() ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'xtra_unit_om')->widget(Select2::class, [
                'data' => ArrayHelper::map(UnitOfMeasure::find()->all(),'id', 'code' ),
                'language' => 'uz',
                'options' => ['multiple' => false, 'prompt' => ''],
                'showToggleAll' => false,
            ]) ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'cnfea_code')->widget(MaskedInput::class, [
                'mask' => '9999999999'
                ])?>
        </div>

    <div class="row">
        <div class="col-sm-3">
            <?= $form->field($model, "xtra_value_identification")->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, "xtra_value_laboratory")->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'bar_code')->textInput(['maxlength' => true]) ?>
        </div>
    </div><!-- .row -->
    
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
