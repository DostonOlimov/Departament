<?php

use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\RiskAnalisysSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="risk-analisys-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php // echo $form->field($model, 'id') ?>

    <?php // echo $form->field($model, 'company_id') ?>

    <?php // echo $form->field($model, 'user_id') ?>

    <?php // echo $form->field($model, 'risk_analisys_date') ?>

    <?php // echo $form->field($model, 'risk_analisys_number') ?>

    
    <div class="col-3">
    <?= $form->field($model, 'start_date')->label(false)->widget(DatePicker::class, [
        'options' => ['placeholder' => 'Boshlanish vaqti'],
        'pluginOptions' => [
            'autoclose'=>true,
            'format' => 'dd.mm.yyyy'
            ]
        ]); ?>
    </div>
    <div class="col-3">
        <?= $form->field($model, 'end_date')->label(false)->widget(DatePicker::class, [
    'options' => ['placeholder' => 'Tugash vaqti'],
    'pluginOptions' => [
        'autoclose'=>true,
        'format' => 'dd.mm.yyyy'
        ]
    ]); ?>  
    </div>
    <?php // echo $form->field($model, 'criteria') ?>

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
