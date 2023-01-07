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
            <?= $form->field($model, 'dn')->dropDownList(Instruction::getDN(),['onclick' => "typeChange(event,this)",]) ?>
        </div>
        <div class="col-sm-6" id = "code">
            <?= $form->field($model, 'letter_number')->widget(\yii\widgets\MaskedInput::className(), [
                'mask' => '999-999-999']) ?>
        </div>
        <div class="col-sm-6" id = "code1" style = "display:none">
            <?= $form->field($model, 'dt_letter')->textInput() ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'command_date')->widget(DatePicker::className()) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'command_number')->textInput(['type' => 'number']) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'letter_date')->widget(DatePicker::className()) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'checkup_begin_date')->widget(DatePicker::className()) ?>
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
            <?= $form->field($model, 'who_send_letter')->TextInput(['type' =>'text']) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'checkup_duration')->dropDownList(Instruction::getDuration()) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <?= $form->field($model, 'checkup_subject')->widget(Select2::class, [
                'data' => Instruction::getSubject(),
                'language' => 'uz',
                'options' => ['multiple' => true],
                'showToggleAll' => false,
            ]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <label>Ijrochi:</label>
            <label class="form-control" readonly><?= Yii::$app->user->id ? User::findOne(Yii::$app->user->id)->name . ' ' . User::findOne(Yii::$app->user->id)->surname : 'Inspektor F.I.О' ?></label>
        </div>
    <div class="col-sm-6">
            <?= $form->field($model, 'employers')->widget(Select2::class, [
                'data' => Instruction::getUsers(),
                'language' => 'uz',
                'options' => ['multiple' => true],
                'showToggleAll' => false,
            ]) ?>
        </div>
    </div>

    <div class="col-12">
        <input type="submit" class="btn btn-info br-btn" value="Saqlash">
    </div>
    <?php ActiveForm::end() ?>

<script>
    function typeChange(e,t) { 
        //obj = findParent(t, 'panel-body');
        if (e.target.value == "1") {
           
        var collection =  document.getElementById("code");
        var collection1 =  document.getElementById("code1");
            collection.style.display = 'none';
            collection1.style.display = 'block';
        }
        if (e.target.value == "0") {
        var col =  document.getElementById("code");
        var col1 =  document.getElementById("code1");
            col.style.display = 'block';
            col1.style.display = 'none';
        }
    }
</script>

