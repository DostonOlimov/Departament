<?php

use yii\helpers\Html;
use common\models\control\InstructionUser;
use common\models\control\Instruction;
use common\models\User;
use frontend\widgets\Steps;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\control\Instruction */

$this->title = 'Tekshiruvni uzaytirish: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Korxonalar', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['/control/control/view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Yangilash';
?>
<div class="control-instruction-update">

<?php $form = ActiveForm::begin() ?>

<div class="row">
    <div class="col-sm-6">
        <label>Tekshiruv uchun asos:</label>
        <label class="form-control" readonly><?= Instruction::getBase($model->base); ?></label>
    </div>

    <div class="col-sm-6">
        <label>Tekshiruv turi:</label>
        <label class="form-control" readonly><?= Instruction::getType($model->type); ?></label>
    </div>
</div>
<div class="row">

    <div class="col-sm-6">
        <?= $form->field($model, 'command_date')->widget(DatePicker::className()) ?>
    </div>
    <div class="col-sm-6">
        <?= $form->field($model, 'command_number')->textInput([]) ?>
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
        <label>Asos bo’luvchi hujjat jo’natuvchi shaxs,xat raqami:</label>
        <label class="form-control" readonly><?= $model->who_send_letter; ?></label>
    </div>
    <div class="col-sm-6">
        <?= $form->field($model, 'checkup_duration')->dropDownList(Instruction::getDuration()) ?>
    </div>  
</div>
<div class="row">
    <div class="col-sm-12">
        <?php  $result = '';
                    $model->checkup_subject = explode('.', substr($model->checkup_subject, 0));
                    foreach ($model->checkup_subject as $key => $type) {
                        $t=$key+1;
                        if($type){
                        $result .= $t.' - '. Instruction::getSubject($type) . "</br>";
                        }
                    }
         ?>
         <label>Tekshiruv predmeti:</label>
        <label class="form-control" readonly><?= $result; ?></label>
    </div>
</div>
<div class="row">
<div class="col-sm-6">
        <label>Tekshiruv boshlangan sanasi:</label>
        <label class="form-control" readonly><?= $model->real_checkup_date ? $model->real_checkup_date : 'Boshlanmagan' ?></label>
    </div>
    <div class="col-sm-6">
        <label>Tekshiruv tugatilgan sanasi:</label>
        <label class="form-control" readonly><?= $model->checkup_finish_date ? $model->checkup_finish_date : 'Yakunlanmagan' ?></label>
    </div>
    <div class="col-sm-6">
        <label>Ijrochi:</label>
        <label class="form-control" readonly><?= Yii::$app->user->id ? User::findOne(Yii::$app->user->id)->name . ' ' . User::findOne(Yii::$app->user->id)->surname : 'Inspektor F.I.О' ?></label>
    </div>
    <div class="col-sm-6">
        <label>Inspektor(lar):</label>
        <?php $user_id = InstructionUser::findALl(['instruction_id' => $model->id]) ?>
        <label class="form-control" readonly><?php
        $name ='';
        foreach($user_id as $user){
            $user->user_id ? $name .= User::findOne($user->user_id)->name . ' ' . User::findOne($user->user_id)->surname.', ' : $name ='Inspektor F.I.О';
        } echo $name; ?></label>
    </div>

</div>

<div class="col-12">
    <input type="submit" class="btn btn-info br-btn" value="Saqlash">
</div>
<?php ActiveForm::end() ?>
</div>
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

