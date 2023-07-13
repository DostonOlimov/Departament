<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\govcontrol\PrimaryDataSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="primary-data-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'company_type_id') ?>

    <?= $form->field($model, 'gov_control_order_id') ?>

    <?= $form->field($model, 'real_control_date_from') ?>

    <?= $form->field($model, 'real_control_date_to') ?>

    <?php // echo $form->field($model, 'quality_management_system') ?>

    <?php // echo $form->field($model, 'product_exists') ?>

    <?php // echo $form->field($model, 'laboratory_exists') ?>

    <?php // echo $form->field($model, 'last_gov_control_date') ?>

    <?php // echo $form->field($model, 'last_gov_control_number') ?>

    <?php // echo $form->field($model, 'comment') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
