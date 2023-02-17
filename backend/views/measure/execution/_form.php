<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

/** @var yii\web\View $this */
/** @var common\models\measure\Executions $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="executions-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'control_instruction_id')->hiddenInput()->label(false); ?>

    <?= $form->field($model, 'person')->textInput(['style'=>"text-transform:uppercase"]) ?>

    <?= $form->field($model, 'number_passport')->widget(MaskedInput::className(), [
                        'mask' => 'AA9999999'
                    ]) ?>
    <?= $form->field($model, 'fine_amount')->textInput(['type' => 'number']) ?>

    <?= $form->field($model, 'paid_amount')->textInput(['type' => 'number']) ?>

    <?= $form->field($model, 'person_position')->textarea(['rows' => 2]) ?>

    <?= $form->field($model, 'caution_number')->textInput(['maxlength' => true, 'type' => 'number']) ?>

    <div class="row">
                    <div class="col-sm-4">
                        <?= $form->field($model, "m212")->dropDownList([0 => '- - -',1=>'1-qismi', 2 => '2-qismi',3=>'3-qismi',4=>'4-qismi'],);?>
                    </div>
                    <div class="col-sm-4">
                        <?= $form->field($model, "m213")->dropDownList([0 => '- - -',1=>'1-qismi', 2 => '2-qismi']);?>
                    </div>
                    <div class="col-sm-4">
                        <?= $form->field($model, "m214")->dropDownList([0 => '- - -',1=>'1-qismi', 2 => '2-qismi']);?>
                    </div>
        </div>
                <div class="col-md-12 col-lg-8"> 
                <table style="color:black;">
                <tr><td class = "label">Tushuntirish xati</td><td><?= $model->explanation_letter ? 'Yuklangan' : $form->field($model, "explanation_letter")->fileInput()->label(false)?></td></tr>
                <tr><td class = "label">Talabnoma</td><td><?= $model->claim ? 'Yuklangan' : $form->field($model, "claim")->fileInput()->label(false) ?></td></tr>
                <tr><td class = "label">Sud xati</td><td><?= $model->court_letter  ? 'Yuklangan' : $form->field($model, "court_letter")->fileInput()->label(false) ?></td></tr>
                </table>
                </div>
    <div class="form-group">
        <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
