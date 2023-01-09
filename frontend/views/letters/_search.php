<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\caution\CautionLettersSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="caution-letters-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'company_id') ?>

    <?= $form->field($model, 'letter_date') ?>

    <?= $form->field($model, 'letter_number') ?>

    <?= $form->field($model, 'upload_file') ?>

    <?php // echo $form->field($model, 'inpector_name') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
