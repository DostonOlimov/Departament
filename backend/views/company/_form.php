<?php

use common\models\Region;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;


/** @var yii\web\View $this */
/** @var common\models\Company $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="company-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'stir')->widget(MaskedInput::className(), [
                'mask' => '999999999'
            ])?>

    <?= $form->field($model, 'company_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'registration_date')->textInput() ?>

    <?= $form->field($model, 'region_id')->dropDownList(ArrayHelper::map(Region::find()->all(), 'id', 'name')) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'thsht')->widget(MaskedInput::className(), [
                'mask' => '999'
            ])?>

    <?= $form->field($model, 'ifut')->widget(MaskedInput::className(), [
                'mask' => '99999'
            ])?>

    <?= $form->field($model, 'ownername')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>



    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
