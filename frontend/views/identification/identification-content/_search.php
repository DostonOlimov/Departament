<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\identification\IdentificationContentSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="identification-content-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'selected_normative_document_id') ?>

    <?= $form->field($model, 'normative_document_content_id') ?>

    <?= $form->field($model, 'comment') ?>

    <?= $form->field($model, 'conformity') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
