<?php

use kartik\date\DatePicker;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

/** @var yii\web\View $this */
/** @var common\models\actselection\ActSelection $model */
/** @var yii\widgets\ActiveForm $form */
$date_pluginOptions =['pluginOptions' => ['autoclose' => true,'format' => 'dd.mm.yyyy']];
?>

<div class="act-selection-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'gov_control_order_id')->textInput(['maxlength' => true, 'readonly' => true]) ?>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-body">
             <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.item', // required: css class
                'limit' => 4, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $models[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                    'act_selection_id',
                    'name',
                    'batch_number',
                    'ctry_ogn_code',
                    'mfr_name',
                    'mfr_id',
                    'mfrd_date',
                    'exptr_ctry_code',
                    'imptr_name',
                    'imptr_id',
                    'prod_netto',
                    'xtra_value',
                    'xtra_unit_om',
                    'cnfea_code',
                ],
            ]); ?>

            <div class="container-items"><!-- widgetContainer -->
            <?php foreach ($models as $i => $modelProduct): ?>
                <div class="item panel panel-default"><!-- widgetBody -->

                    <div class="panel-heading">
                        <div class="pull-right">
                            <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                            <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <div class="panel-body">
                        <?php
                            // necessary for update action.
                            if (! $modelProduct->isNewRecord) {
                                echo Html::activeHiddenInput($modelProduct, "[{$i}]id");
                            }
                        ?>
                        <div class="row">
                            <div class="col-sm-9">
                                <?= $form->field($modelProduct, "[{$i}]name")->textarea(['maxlength' => true]) ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($modelProduct, "[{$i}]act_selection_id")->hiddenInput()->label(false) ?>
                                <?= $form->field($modelProduct, "[{$i}]bar_code")->textInput() ?>
                            </div>
                        </div><!-- .row -->
                        <div class="row">
                            <div class="col-sm-3">
                                <?= $form->field($modelProduct, "[{$i}]batch_number")->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($modelProduct, "[{$i}]ctry_ogn_code")->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($modelProduct, "[{$i}]mfr_name")->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($modelProduct, "[{$i}]mfr_id")->widget(MaskedInput::class, ['mask' => '999999999']) ?>
                            </div>
                        </div><!-- .row -->
                        <div class="row">
                            <div class="col-sm-3">
                                <?= $form->field($modelProduct, "[{$i}]mfrd_date")->widget(DatePicker::class,$date_pluginOptions) ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($modelProduct, "[{$i}]exptr_ctry_code")->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($modelProduct, "[{$i}]imptr_name")->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($modelProduct, "[{$i}]imptr_id")->widget(MaskedInput::class, ['mask' => '999999999']) ?>
                            </div>
                        </div><!-- .row -->
                        <div class="row">
                            <div class="col-sm-3">
                                <?= $form->field($modelProduct, "[{$i}]prod_netto")->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($modelProduct, "[{$i}]xtra_value")->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($modelProduct, "[{$i}]xtra_unit_om")->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($modelProduct, "[{$i}]cnfea_code")->widget(MaskedInput::class, ['mask' => '9999999999']) ?>
                            </div>
                        </div><!-- .row -->
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
            <?php DynamicFormWidget::end(); ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($modelProduct->isNewRecord ? 'Yaratish' : 'Yangilash', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
