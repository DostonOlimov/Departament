<?php
use common\models\control\Company;
use common\models\control\PrimaryProduct;
use common\models\control\ControlProductCertification;
use common\models\control\PrimaryData;
use frontend\widgets\Steps;
use kartik\file\FileInput;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\date\DatePicker;
use yii\helpers\VarDumper;
use yii\helpers\Html;

$this->title = 'Korxona';
$this->params['breadcrumbs'][] = $this->title;
$primaryData = PrimaryData::findOne(['control_company_id' => $company_id]);
?>
  <p>
    <?php Html::a('Mahsulotlar', ['/control/primary-products/index', 'primary_data_id' => $primaryData->id,'company_id' => $company_id], ['class' => 'btn btn-info']) ?>
    <?php Html::a('O\'lchov vositalari', ['/control/primary-ov/index', 'primary_data_id' => $primaryData->id,'company_id' => $company_id], ['class' => 'btn btn-info']) ?>
    </p>
<div class="page1-1 row">

    <?= Steps::widget([
        'control_instruction_id' => Company::findOne($company_id)->control_instruction_id,
        'control_company_id' => $company_id,
    ]) ?>   

    <?php $form = ActiveForm::begin([
//        'enableClientValidation' => false,
//        'enableAjaxValidation' => true,
//        'validateOnChange' => true,
//        'validateOnBlur' => false,
        'options' => [
            'enctype' => 'multipart/form-data',
            'id' => 'dynamic-form'
        ]
        ]) ?>
<div>
    <i class="fa fa-toggle-right" id = "open1" onclick=openPanel(); style="font-size:24px;color:blue;display:none;"></i> 
    <i class="fa fa-toggle-down " id = "close1" onclick=closePanel(); style="font-size:24px;color:blue; " ></i> 
    <h4 style = 'color:black; display:inline;'>Tashqi ko’rinish bayonnomasi</h4>
    <div class="row" id = "content1" >
        <?php foreach ($model as $key => $stan) :?>
            <div class="panel-body">        
                     <div class="col-md-6 col-lg-12">
                        <label>Mahsulot nomi:</label>
                            <label class="form-control" style = "background-color:rgb(57, 71, 227); color:white;" readonly><?= $stan['product_name'] ?></label>
                        <?= $form->field($stan, "[{$key}]product_id")->hiddenInput(['value'=> $stan['product_id']])->label(false);?>
                        </div>
                    <div class="row">
                        <div class="col-md-6 col-lg-4">
                            <?= $form->field($stan, "[{$key}]quality")->radioList( 
                                [1=>'Muvofiq', 0 => 'Nomuvofiq'],['onclick' => "defectChange(event,this)",] );?>
                        </div>
                        <div class="col-md-6 col-lg-6 defect">
                     <?= $form->field($stan, "[{$key}]defect_type")->widget(Select2::class, [
                         'data' => PrimaryProduct::getDefect(),
                        'language' => 'uz',
                         'options' => ['multiple' => true],
                         'showToggleAll' => false,
                         ]) ?>
                    </div>
                </div>
                        <div class="col-md-6 col-lg-8">
                            <?= $form->field($stan, "[{$key}]description")->textarea() ?>
                        </div> 
                        <?php if($stan['certification'] > 0) :?>   
                        <div class="col-md-6 col-lg-12">
                            <?= $form->field($stan, "[{$key}]breaking_certification")->radioList( 
                                [1=>'ha', 0 => 'yo\'q'],['onclick' => "typeChange(event,this)",] );?>
                        </div>
                        <div class="row certificate" style = "display: none">
                        <div class="col-md-6 col-lg-6">
                            <?= $form->field($stan, "[{$key}]quantity")->textInput() ?>
                        </div> 
                        <div class="col-md-6 col-lg-6">
                            <?= $form->field($stan, "[{$key}]amount")->textInput() ?>
                        </div> 
                        </div>  
                        <?php endif ;?>
                     </div>
                    <?php endforeach; ?>
                    </div>
</div>
<div style = "padding-top:20px">
        <i class="fa fa-toggle-right" id = "open2" onclick=openPanel2(); style="font-size:24px;color:blue;display:none;"></i> 
        <i class="fa fa-toggle-down " id = "close2" onclick=closePanel2(); style="font-size:24px;color:blue; " ></i> 
        <h4 style = 'color:black;display:inline;'>Sinov labalatoriyasi xulosasi</h4>
       
        <div class="row" id="content2" >
        <?php foreach ($labs as $key => $stan) :?>        
                     <div class="col-md-6 col-lg-12">
                        <label>Mahsulot nomi:</label>
                            <label class="form-control" style = "background-color:rgb(57, 71, 227); color:white;" readonly><?= $stan['product_name'] ?></label>
                        <?= $form->field($stan, "[{$key}]product_id")->hiddenInput(['value'=> $stan['product_id']])->label(false);?>
                     </div>
                        <div class="col-md-6 col-lg-4">
                            <?= $form->field($stan, "[{$key}]quality")->radioList( 
                                [1=>'Muvofiq', 0 => 'Nomuvofiq',2=>'Vaqtincha no\'malum'], );?>
                        </div>
                        <div class="col-md-6 col-lg-8">
                            <?= $form->field($stan, "[{$key}]description")->textarea() ?>
                        </div>   
                    <?php endforeach; ?>
            </div>
        </div>

    <div class="col-12" style = "padding-top:20px">
        <input type="submit" class="btn btn-info br-btn" value="Saqlash">
    </div>

    <?php ActiveForm::end() ?>

</div>
<script>
function findParent(elem, className){
        if (elem.parentNode.classList.contains(className)){
            return elem.parentNode;
        }

        return findParent(elem.parentNode,className);

    }
 function typeChange(e,t) {
        obj = findParent(t, 'panel-body');
        if (e.target.value == "1" && e.target.checked) {
            
        var collection =  obj.getElementsByClassName("certificate");
        for (var i=0;i<collection.length;i++)
        {
            collection[i].style.display = 'flex';
        }
        }
        if (e.target.value == "0" && e.target.checked) {
            let inputs = obj.getElementsByClassName('certificate');
            for (let i = 0; i < inputs.length; i++) {
                inputs[i].style.display = 'none';
            }
        }
    }

function defectChange(e,t) {
        obj = findParent(t, 'panel-body');
        if (e.target.value == "0" && e.target.checked) {
        
        var collection =  obj.getElementsByClassName("defect");
        for (var i=0;i<collection.length;i++)
        {
            collection[i].style.display = 'block';
        }
        }
        if (e.target.value == "1" && e.target.checked) {
            let inputs = obj.getElementsByClassName('defect');
            for (let i = 0; i < inputs.length; i++) {
                inputs[i].style.display = 'none';
            }
        }
    }
function openPanel() {

var  item1 = document.getElementById('open1');
var  item2 = document.getElementById('close1');
var item3 = document.getElementById('content1');

item1.style.display = 'none';
item2.style.display = 'inline';
item3.style.display = 'flex'


}
function closePanel() {

var  item1 = document.getElementById('open1');
var  item2 = document.getElementById('close1');
var item3 = document.getElementById('content1');

item1.style.display = 'inline';
item2.style.display = 'none';
item3.style.display = 'none'

}
function openPanel2() {

var  item1 = document.getElementById('open2');
var  item2 = document.getElementById('close2');
var item3 = document.getElementById('content2');

item1.style.display = 'none';
item2.style.display = 'inline';
item3.style.display = 'flex'

}
function closePanel2() {

var  item1 = document.getElementById('open2');
var  item2 = document.getElementById('close2');
var item3 = document.getElementById('content2');

item1.style.display = 'inline';
item2.style.display = 'none';
item3.style.display = 'none'

}

</script>

