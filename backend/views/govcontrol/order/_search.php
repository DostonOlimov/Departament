<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\govcontrol\OrderSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="order-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'parent_id') ?>

    <?= $form->field($model, 'gov_control_program_id') ?>

    <?= $form->field($model, 'control_period_from') ?>

    <?= $form->field($model, 'control_period_to') ?>

    <?php // echo $form->field($model, 'control_date_from') ?>

    <?php // echo $form->field($model, 'control_date_to') ?>

    <?php // echo $form->field($model, 'ombudsman_code_date') ?>

    <?php // echo $form->field($model, 'ombudsman_code_number') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
