<?php

use common\models\Region;
use common\models\control\Company;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

/* @var $this yii\web\View */
/* @var $model common\models\control\Company */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="company-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'region_id')->dropDownList(ArrayHelper::map(Region::find()->all(), 'id', 'name')) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'inn')->widget(MaskedInput::className(), [
                'mask' => '999999999'
            ]) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'soogu')->widget(MaskedInput::className(), [
                'mask' => '99999'
            ]) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'ifut')->widget(MaskedInput::className(), [
                'mask' => '99999'
            ]) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'thsht')->widget(MaskedInput::className(), [
                'mask' => '999'
            ]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'type')->dropDownList(Company::getType(),) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'phone')->widget(MaskedInput::className(), [
                'mask' => '(99)-999-99-99'
            ]) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'ownername')->textInput(['maxlength' => true]) ?>
        </div>
    </div>


    <div class="form-group">
        <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
