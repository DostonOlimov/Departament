<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\normativedocument\NormativeDocumentSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="normative-document-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'category_id') ?>

    <?= $form->field($model, 'determination') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'activation_date') ?>

    <?php // echo $form->field($model, 'activation_info') ?>

    <?php // echo $form->field($model, 'deactivation_date') ?>

    <?php // echo $form->field($model, 'deactivation_info') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
