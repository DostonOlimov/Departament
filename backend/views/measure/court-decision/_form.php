<?php

use common\models\measure\CourtsName;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use yii\widgets\MaskedInput;

/** @var yii\web\View $this */
/** @var common\models\measure\CourtDecision $model */
/** @var yii\widgets\ActiveForm $form */
// if($model->paid_acount){
//     echo $model->paid_acount;
//     $model->paid_acount = trim($model->paid_acount);
// }
// die();
?>

<div class="court-decision-form">

    <?php $form = ActiveForm::begin(); ?>
 <div class="row">
<div class="col-sm-6">
    <?= $form->field($model, 'court_id')->dropDownList(ArrayHelper::map(CourtsName::find()->all(), 'id', 'name')) ?>
</div>
<div class="col-sm-6">
    <?= $form->field($model, 'decision_date')->widget(DatePicker::className(),['pluginOptions' => [
        'autoclose' => true,
        'format' => 'dd.mm.yyyy'
    ]]) ?>
</div>
<div class="col-sm-6">
    <?= $form->field($model, "decision_file")->fileInput() ?>
</div>
<di class="col-sm-6">
<?= $form->field($model, 'fine_excist')->dropDownList([
        0 => 'jarima qo\'lanildi',
        1 => 'jarima qo\'lanilmadi'
],['onclick' => "typeChange(event,this)"]) ?> 
</div>
<div class = "row fine">
<div class="col-sm-6">
    <?= $form->field($model, 'fine_amount')->textInput(['type' => 'number']) ?>
    </div>
<div class="col-sm-6">
    <?= $form->field($model, 'paid_amount')->textInput(['type' => 'number']) ?>
    </div>
<div class="col-sm-6">
    <?= $form->field($model, 'paid_date')->widget(DatePicker::className(),['pluginOptions' => [
        'autoclose' => true,
        'format' => 'dd.mm.yyyy'
    ]]) ?>
    </div>
<div class="col-sm-6">
    <?= $form->field($model, 'discont')->dropDownList([
        0 => 'yo\'q',
        1 => 'bor'
    ]) ?>
    </div>
<div class="col-sm-6">
    <?= $form->field($model, 'paid_acount')->widget(MaskedInput::className(), [
                        'mask' => '9999 9999 9999 9999'
                    ]) ?>
    </div>
</div>

<div class="col-sm-6 " id="comment" style="display:none">
    <?= $form->field($model, 'comment')->textarea() ?>
</div>
  
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
<script>
     function typeChange(e,t) {
        
        if (e.target.value == "0"  ) {
            
        var collection =  document.getElementsByClassName("fine");
        document.getElementById("comment").style.display = "none";
        for (var i=0;i<collection.length;i++)
        {
            collection[i].style.display = 'flex';
        }
        
        }
        if (e.target.value == "1" ) {
            let inputs = document.getElementsByClassName('fine');
            document.getElementById("comment").style.display = "block";
            for (let i = 0; i < inputs.length; i++) {
                inputs[i].style.display = 'none';
            }
          
        }
    }
    </script>
