<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\measure\EconomicsSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="economics-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'control_instruction_id') ?>

    <?= $form->field($model, 'first_warn_date') ?>

    <?= $form->field($model, 'number_passport') ?>

    <?= $form->field($model, 'warn_number') ?>

    <?php // echo $form->field($model, 'eco_date') ?>

    <?php // echo $form->field($model, 'eco_number') ?>

    <?php // echo $form->field($model, 'eco_quantity') ?>

    <?php // echo $form->field($model, 'eco_amount') ?>

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
