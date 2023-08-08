<?php

use common\models\Region;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;
use kartik\date\DatePicker;


/** @var yii\web\View $this */
/** @var common\models\Company $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="company-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'stir')->widget(MaskedInput::class, [
                'mask' => '999999999'
            ])?>

    <?= $form->field($model, 'company_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'registration_date')->widget(DatePicker::class,
    [
        'pluginOptions' => 
        [
            'autoclose' => true,
            'format' => 'dd.mm.yyyy'
        ]
    ]) ?>

    <?= $form->field($model, 'region_id')->dropDownList(ArrayHelper::map(Region::find()->all(), 'id', 'name')) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'thsht')->widget(MaskedInput::class, [
                'mask' => '999'
            ])?>

    <?= $form->field($model, 'ifut')->widget(MaskedInput::class, [
                'mask' => '99999'
            ])?>

    <?= $form->field($model, 'ownername')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->widget(MaskedInput::class, ['mask' => '(99)-999-99-99']) ?>

    <?= $form->field($model, 'status')->dropDownList($model->getStatus()) ?>

    <div class="form-group">
        <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
