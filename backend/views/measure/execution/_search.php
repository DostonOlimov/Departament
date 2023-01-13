<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\measure\ExecutionsSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="executions-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'control_instruction_id') ?>

    <?= $form->field($model, 'person') ?>

    <?= $form->field($model, 'number_passport') ?>

    <?= $form->field($model, 'fine_amount') ?>

    <?php // echo $form->field($model, 'paid_amount') ?>

    <?php // echo $form->field($model, 'band_mjtk') ?>

    <?php // echo $form->field($model, 'explanation_letter') ?>

    <?php // echo $form->field($model, 'claim') ?>

    <?php // echo $form->field($model, 'court_letter') ?>

    <?php // echo $form->field($model, 'person_position') ?>

    <?php // echo $form->field($model, 'first_date') ?>

    <?php // echo $form->field($model, 'caution_number') ?>

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
