<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\embargo\EmbargoSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="embargo-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'instructions_id') ?>

    <?= $form->field($model, 'companies_id') ?>

    <?= $form->field($model, 'comment') ?>

    <?= $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'message_date') ?>

    <?php // echo $form->field($model, 'inspector_name') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
