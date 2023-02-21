<?php
use common\models\control\DocumentAnalysis;
use kartik\date\DatePicker;
use yii\widgets\ActiveForm;
use common\models\control\InstructionType;

/* @var $this yii\web\View */
/* @var $model Instruction */

$this->title = 'Davlat nazoratini o\'tkazish uchun asos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page2 row">
    
    <?php $form = ActiveForm::begin() ?>
    <div class="row">
    <div class="col-sm-3"></div>
        <div class="col-sm-6" style="font-size:24px;">
            <?= $form->field($model, 'date')->widget(DatePicker::className(),['pluginOptions' => [
        'autoclose' => true,
        'format' => 'dd.mm.yyyy'
    ]]) ?>
        </div>
        <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6" style="font-size:24px">
            <?= $form->field($model, 'type')->checkboxList(InstructionType::typeList(), [
                'onclick' => 'typeChange(event)',
                'class' => 'row',
            ]) ?>
        </div>
    </div>
    </div>
    <div class="row">
    <div class="col-sm-3"></div>
    <div class="col-sm-6">
        <input type="submit" class="btn btn-info br-btn" value="Boshlash">
    </div>
    <?php ActiveForm::end() ?>
    </div>
</div>
<script>
     function typeChange(e) {
        if (e.target.value == "4" && e.target.checked) {
            let inputs = document.querySelectorAll("#instructiontype-type input:not(lastchild)")
            inputs.forEach(input => {
                    if (input.value != "4") {
                        input.setAttribute('disabled', 'disabled')
                    }
                }
            )
        }
        if (e.target.value == "4" && !e.target.checked) {
            let inputs = document.querySelectorAll("#instructiontype-type input:not(lastchild)")
            inputs.forEach(input => {
                    if (input.value != "4") {
                        input.removeAttribute('disabled')
                    }
                }
            )
        }
        // console.log(e)
    }
</script>
