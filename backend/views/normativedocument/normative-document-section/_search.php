<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\normativedocument\NormativeDocumentSectionSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="normative-document-section-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'normative_document_id') ?>

    <?= $form->field($model, 'section_category_id') ?>

    <?= $form->field($model, 'section_number') ?>

    <?= $form->field($model, 'section_name') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
