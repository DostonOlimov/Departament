<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Company;

/** @var yii\web\View $this */
/** @var common\models\govcontrol\Program $model */
/** @var yii\widgets\ActiveForm $form */
// debug($model);
// debug(Company::findOne(['id' => $model->company_id]));
?>

<div class="program-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'company_id')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'company_name')->textInput(
        [
            'readonly' => true, 
            'value' => Company::findOne($model->company_id)->company_name
        ]
            ) ?>

    <?= $form->field($model, 'company_type_id')->dropDownList($model->getCompanyType()) ?>

    <?= $form->field($model, 'gov_control_type')->dropDownList($model->getGovcontrolType()) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
