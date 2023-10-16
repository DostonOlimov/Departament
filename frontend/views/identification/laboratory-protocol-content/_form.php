<?php

use common\models\normativedocument\NormativeDocument;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\identification\LaboratoryProtocolContent $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="laboratory-protocol-content-form">

<div class="row">
                            <div class="col-sm-3">
                                <?php echo $form->field($model, "normative_document_id")->dropDownList(NormativeDocument::getNormativeDocumentNames(), ['prompt' => '']); 
                                // debug($form->field($model, "[{$i}]normative_document_id"));
                                ?>
                            </div>
                            <div class="col-sm-4">
                                <?= $form->field($model, "requirement_link")->textInput() ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($model, "indicator_name")->textInput() ?>
                            </div>
                            <div class="col-sm-2">
                                <?= $form->field($model, "unit_om")->dropDownList($model->getListOfUnitOfMeasure(), ['prompt' => ''])?>
                            </div>
                        </div><!-- .row -->

                        <div class="row">
                            <div class="col-sm-4">
                                <?= $form->field($model, "requirement_min")->textInput(['maxlength' => true]) ?>
                                <?= $form->field($model, "condition1")->checkbox(
                                    [
                                        // 'label' => $value->name,
                                        'checked' => false,
                                        // 'uncheck' => 0,
                                    ]); ?>
                            </div>
                            <div class="col-sm-4">
                                <?= $form->field($model, "requirement_max")->textInput(['maxlength' => true]) ?>
                                <?= $form->field($model, "condition2")->checkbox(
                                    [
                                        // 'label' => $value->name,
                                        'checked' => false,
                                        // 'uncheck' => 0,
                                    ]); ?>
                            </div>
                            <div class="col-sm-4">
                                    <?= $form->field($model, "current_value")->textInput(['maxlength' => true]) ?>
                            </div>
                        </div><!-- .row -->
</div>
