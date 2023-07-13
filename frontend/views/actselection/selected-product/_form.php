<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\actselection\SelectedProduct $model */
/** @var yii\widgets\ActiveForm $form */
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
            <?= $form->field($model, 'ctry_ogn_code')->textInput() ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'mfr_name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'mfr_id')->textInput() ?>
        </div>
    </div><!-- .row -->
    <div class="row">
        <div class="col-sm-3">
            <?= $form->field($model, 'mfrd_date')->textInput() ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'exptr_ctry_code')->textInput() ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'imptr_name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'imptr_id')->textInput() ?>
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
            <?= $form->field($model, 'xtra_unit_om')->textInput() ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'cnfea_code')->textInput(['maxlength' => true]) ?>
        </div>
    </div><!-- .row -->
    <div class="row">
        <div class="col-sm-3">
            <?= $form->field($model, 'bar_code')->textInput(['maxlength' => true]) ?>
        </div>
    </div><!-- .row -->

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
