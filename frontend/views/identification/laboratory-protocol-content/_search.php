<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\identification\LaboratoryProtocolContentSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="laboratory-protocol-content-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'laboratory_protocol_id') ?>

    <?= $form->field($model, 'normative_document_id') ?>

    <?= $form->field($model, 'indicator_name') ?>

    <?= $form->field($model, 'requirement_link') ?>

    <?php // echo $form->field($model, 'requirement_range') ?>

    <?php // echo $form->field($model, 'requirement_min') ?>

    <?php // echo $form->field($model, 'requirement_max') ?>

    <?php // echo $form->field($model, 'current_value') ?>

    <?php // echo $form->field($model, 'unit_om') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
