<?php

use common\models\LocalActiveRecord;
use common\models\normativedocument\NormativeDocument;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\identification\LaboratoryProtocol $model */

$this->title = 'Laboratoriya bayonnomasi: '. $selected_product->name;
$this->params['breadcrumbs'][] = ['label' => 'Laboratory Protocols', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$date_pluginOptions =['pluginOptions' => ['autoclose' => true,'format' => 'dd.mm.yyyy']];
?>
<h1> <?= $this->title ?> </h1>
<div class="laboratory-protocol-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>
    
    <?= $this->render('_form', ['model' => $model, 'form' => $form ]) ?>

    <div class="panel panel-default">
        <div class="panel-body">
             <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.item', // required: css class
                'limit' => 100, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $models[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                    'selected_product_id',
                    'normative_document_id',
                    'indicator_name',
                    'requirement_link',
                    'requirement_range',
                    'requirement_min',
                    'requirement_max',
                    'unit_om',
                    'current_value',
                    'condition1',
                    'condition2'
                ],
            ]); ?>

                <?php 
                    $list = LocalActiveRecord::getListOfUnitOfMeasure();
                ?>

            <div class="container-items"><!-- widgetContainer -->
            <?php foreach ($models as $i => $model): ?>
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
                            if (! $model->isNewRecord) { echo Html::activeHiddenInput($model, "[{$i}]id"); }
                        ?>
                        <div class="row">
                            <div class="col-sm-3">
                                <?= $form->field($model, "[{$i}]normative_document_id")->dropDownList(NormativeDocument::getNormativeDocumentNames(), ['prompt' => '']) ?>
                            </div>
                            <div class="col-sm-4">
                                <?= $form->field($model, "[{$i}]requirement_link")->textInput() ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($model, "[{$i}]indicator_name")->textInput() ?>
                            </div>
                            <div class="col-sm-2">
                                <?= $form->field($model, "[{$i}]unit_om")->dropDownList($model->getListOfUnitOfMeasure(), ['prompt' => ''])?>
                            </div>
                        </div><!-- .row -->

                        <div class="row">
                            <div class="col-sm-4">
                                <?= $form->field($model, "[{$i}]requirement_min")->textInput(['maxlength' => true]) ?>
                                <?= $form->field($model, "[{$i}]condition1")->checkbox(
                                    [
                                        // 'label' => $value->name,
                                        'checked' => false,
                                        // 'uncheck' => 0,
                                    ]); ?>
                            </div>
                            <div class="col-sm-4">
                                <?= $form->field($model, "[{$i}]requirement_max")->textInput(['maxlength' => true]) ?>
                                <?= $form->field($model, "[{$i}]condition2")->checkbox(
                                    [
                                        // 'label' => $value->name,
                                        'checked' => false,
                                        // 'uncheck' => 0,
                                    ]); ?>
                            </div>
                            <div class="col-sm-4">
                                    <?= $form->field($model, "[{$i}]current_value")->textInput(['maxlength' => true]) ?>
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
        <?= Html::submitButton($model->isNewRecord ? 'Yaratish' : 'Yangilash', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
