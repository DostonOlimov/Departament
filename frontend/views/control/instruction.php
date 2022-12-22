<?php
use common\models\control\InstructionUser;
use common\models\control\Instruction;
use common\models\User;
use frontend\widgets\Steps;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model Instruction */

$this->title = 'Davlat nazoratini o\'tkazish uchun asos';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="page1-1 row">

    <?= Steps::widget([
        'control_instruction_id' => null,
        'control_company_id' => null,
    ]) ?>

    <?php $form = ActiveForm::begin() ?>

    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'base')->dropDownList(Instruction::getBase()) ?>
        </div>

        <div class="col-sm-6">
            <?= $form->field($model, 'type')->dropDownList(Instruction::getType()) ?>
        </div>
    </div>
    <div class="row">
    <div class="col-sm-6">
            <?= $form->field($model, 'code')->widget(\yii\widgets\MaskedInput::className(), [
                'mask' => '999-999-999']) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'who_send_letter')->TextInput(['type' =>'text']) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'command_date')->widget(DatePicker::className()) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'command_number')->textInput(['type' => 'text']) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'letter_date')->widget(DatePicker::className()) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'letter_number')->textInput(['type'=>'text']) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'checkup_begin_date')->widget(DatePicker::className()) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'real_checkup_date')->widget(DatePicker::className()) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'checkup_duration_start_date')->widget(DatePicker::className()) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'checkup_duration_finish_date')->widget(DatePicker::className()) ?>
        </div>
    </div>
    <div class="row">
    <div class="col-sm-6">
            <?= $form->field($model, 'employers')->widget(Select2::class, [
                'data' => Instruction::getUsers(),
                'language' => 'uz',
                'options' => ['multiple' => true],
                'showToggleAll' => false,
            ]) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'checkup_duration')->dropDownList(Instruction::getDuration()) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <?= $form->field($model, 'checkup_subject')->checkboxList(Instruction::getSubject() );?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-9">
            <label>Ijrochi:</label>
            <label class="form-control" readonly><?= Yii::$app->user->id ? User::findOne(Yii::$app->user->id)->name . ' ' . User::findOne(Yii::$app->user->id)->surname : 'Inspektor F.I.О' ?></label>
        </div>
    </div>

    <div class="col-12">
        <input type="submit" class="btn btn-info br-btn" value="Saqlash">
    </div>
    <?php ActiveForm::end() ?>

</div>
