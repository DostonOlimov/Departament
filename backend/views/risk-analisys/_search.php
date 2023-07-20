<?php

use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\RiskAnalisysSearch $model */
/** @var yii\widgets\ActiveForm $form */
// debug($model);
?>

<div class="risk-analisys-search-row-container">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php // echo $form->field($model, 'id') ?>

    <?php // echo $form->field($model, 'company_id') ?>

    <?php // echo $form->field($model, 'risk_analisys_date') ?>

    <?php // echo $form->field($model, 'risk_analisys_number') ?>

    <?php // echo $form->field($model, 'created_by') ?>
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

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>


    <div class="form-group">
        <?= Html::submitButton('Qidirish', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('O\'chirish', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
