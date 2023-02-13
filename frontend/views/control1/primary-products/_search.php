<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\control\PrimaryProductSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="primary-product-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'control_primary_data_id') ?>

    <?= $form->field($model, 'product_type_id') ?>

    <?= $form->field($model, 'product_name') ?>

    <?= $form->field($model, 'made_country') ?>

    <?php // echo $form->field($model, 'product_measure') ?>

    <?php // echo $form->field($model, 'residue_amount') ?>

    <?php // echo $form->field($model, 'residue_quantity') ?>

    <?php // echo $form->field($model, 'potency') ?>

    <?php // echo $form->field($model, 'year_amount') ?>

    <?php // echo $form->field($model, 'year_quantity') ?>

    <?php // echo $form->field($model, 'labaratory_checking') ?>

    <?php // echo $form->field($model, 'certification') ?>

    <?php // echo $form->field($model, 'photo') ?>

    <?php // echo $form->field($model, 'quality') ?>

    <?php // echo $form->field($model, 'cer_amount') ?>

    <?php // echo $form->field($model, 'cer_quantity') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'codetnved') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
