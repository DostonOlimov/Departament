<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\control\ControlPrimaryOvNd $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="control-primary-ov-nd-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ov_id')->textInput() ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
