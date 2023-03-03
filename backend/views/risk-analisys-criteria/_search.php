<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\RiskAnalisysCriteriaSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="risk-analisys-criteria-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'document_paragraph') ?>

    <?= $form->field($model, 'criteria_category') ?>

    <?= $form->field($model, 'criteria') ?>

    <?= $form->field($model, 'company_field_category') ?>

    <?php // echo $form->field($model, 'criteria_score_one') ?>

    <?php // echo $form->field($model, 'criteria_score_two') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
