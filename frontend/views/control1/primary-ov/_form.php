<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\control\PrimaryOv */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="primary-ov-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-9">
            <?= $form->field($model, 'type')->dropDownList($model::getType()) ?>
            </div>
        <div class="col-md-6">
            <?= $form->field($model, 'measurement')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'compared')->textInput(['maxlength' => true]) ?>
            </div>
        <div class="col-md-6">
            <?= $form->field($model, 'invalid')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'uncompared')->textInput(['maxlength' => true]) ?>
            </div>
        <div class="col-md-6">
            <?= $form->field($model, 'expired')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'unworked')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="form-group">
            <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success']) ?>
        </div>

    </div>

    <?php ActiveForm::end(); ?>

</div>
