<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Company;
use common\models\govcontrol\ProgramData;
use common\models\govcontrol\ProgramProperty;
use common\models\normativedocument\NormativeDocument;
use kartik\select2\Select2;

/** @var yii\web\View $this */
/** @var common\models\govcontrol\Program $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="program-form container">
    <?php 
    // debug(NormativeDocument::class,false);
    // debug(ProgramProperty::class,false);
    // debug(NormativeDocument::getNormativeDocumentNames());
    // debug(ProgramProperty::getProgramDataNames(7));
    ?>

    <?php $form = ActiveForm::begin(); ?>
<h3>
    <div class="">
        O'zekiston texnik jihatdan tartibga solish agentligining davlat nazorati departamenti tomonidan 
        <span><?= $company->address?></span>da joylashgan <span><?= $company->company_name?></span> 
        (STIR: <span><?= $company->stir?></span>, IFUT: <span><?= $company->ifut?></span>) da texnik jihatdan tartibga solish, 
        standartlashtirish, sertifikatlashtirish va metrologiya qoida va me'yorlariga rioya etilishi yuzasidan tekshirish
    </div>
    <div style="text-align:center">
    <b>DASTURI</b>
    </div>
</h3>
    <?= $form->field($model, 'company_id')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'company_type_id')->dropDownList($model->getCompanyType(), ['prompt' => '']) ?>

    <?= $form->field($model, 'gov_control_type')->dropDownList($model->getGovcontrolType(), ['prompt' => '']) ?>
    <?php foreach(ProgramData::getCategory() as $key => $value) :?>
        <?php 
        echo $form->field($model, "property[{$key}]")->widget(Select2::class,[
            'data' => ProgramProperty::getProgramDataNames($key),
            'language' => 'uz',
            'options' => ['multiple' => true],
            'showToggleAll' => false,
        ])->label($value); ?>
    <?php endforeach ?>
    
    <div class="form-group">
        <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success', 'name' => 'save']) ?>
        
    </div>

    <?php ActiveForm::end(); ?>

</div>
