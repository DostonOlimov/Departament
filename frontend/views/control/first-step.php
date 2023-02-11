<?php
use common\models\control\DocumentAnalysis;
use kartik\date\DatePicker;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model Instruction */

$this->title = 'Davlat nazoratini o\'tkazish uchun asos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page1-1 row">
    <?php $form = ActiveForm::begin() ?>
    <div class="row">
        <div class="col-sm-12" style="font-size:24px">
            <?= $form->field($model, 'first_date')->widget(DatePicker::className(),['pluginOptions' => [
        'autoclose' => true,
        'format' => 'dd.mm.yyyy'
    ]]) ?>
        </div>
    </div>
    <div class="col-12">
        <input type="submit" class="btn btn-info br-btn" value="Boshlash">
    </div>
    <?php ActiveForm::end() ?>

</div>
<script>

    function typeChange(e) {
        
        
        if (e.target.value == "1000" && e.target.checked) {
            
            let inputs = document.querySelectorAll("#instruction-start_type input:not(lastchild)")
            
            inputs.forEach(input => {
                    if (input.value != "1000") {
                        input.setAttribute('disabled', 'disabled')
                    }
                }
            )
        }
        if (e.target.value == "1000" && !e.target.checked) {
            let inputs = document.querySelectorAll("#instruction-start_type input:not(lastchild)")
            inputs.forEach(input => {
                    if (input.value != "1000") {
                        input.removeAttribute('disabled')
                    }
                }
            )
        }
        // console.log(e)
    }

</script>