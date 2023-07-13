<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\actselection\SelectedProductSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="selected-product-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'act_selection_id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'batch_number') ?>

    <?= $form->field($model, 'ctry_ogn_code') ?>

    <?php // echo $form->field($model, 'mfr_name') ?>

    <?php // echo $form->field($model, 'mfr_id') ?>

    <?php // echo $form->field($model, 'mfrd_date') ?>

    <?php // echo $form->field($model, 'exptr_ctry_code') ?>

    <?php // echo $form->field($model, 'imptr_name') ?>

    <?php // echo $form->field($model, 'imptr_id') ?>

    <?php // echo $form->field($model, 'prod_netto') ?>

    <?php // echo $form->field($model, 'xtra_value') ?>

    <?php // echo $form->field($model, 'xtra_unit_om') ?>

    <?php // echo $form->field($model, 'cnfea_code') ?>

    <?php // echo $form->field($model, 'bar_code') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
