<?php
use common\models\control\Company;
use common\models\control\PrimaryProduct;
use common\models\control\ControlProductCertification;
use frontend\widgets\Steps;
use kartik\file\FileInput;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use yii\helpers\VarDumper;

$this->title = 'Korxona';
$this->params['breadcrumbs'][] = $this->title;
/*foreach ($certificates as $key => $stan){

    VarDumper::dump($certificates[$key]['product_id'],12,true);
}
die();*/
?>

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
    <i class="fa fa-toggle-right" id = "open1" onclick=openPanel(); style="font-size:24px;color:blue;"></i> 
    <i class="fa fa-toggle-down " id = "close1" onclick=closePanel(); style="font-size:24px;color:blue; display:none;" ></i> 
    <h4 style = 'color:black; display:inline;'>Tashqi ko’rinish bayonnomasi</h4>
    <div class="row" id = "content1" style = "display:none">
        <?php foreach ($model as $key => $stan) :?>        
                     <div class="col-md-6 col-lg-9">
                        <label>Mahsulot nomi:</label>
                            <label class="form-control" readonly><?= $stan['product_name'] ?></label>
                        <?= $form->field($stan, "[{$key}]product_id")->hiddenInput(['value'=> $stan['product_id']])->label(false);?>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <?= $form->field($stan, "[{$key}]quality")->radioList( 
                                [1=>'Sifatli', 0 => 'Sifatsiz'], );?>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <?= $form->field($stan, "[{$key}]description")->textarea() ?>
                        </div>   
                    <?php endforeach; ?>
                    </div>
</div>
<div style = "padding-top:20px">
        <i class="fa fa-toggle-right" id = "open2" onclick=openPanel2(); style="font-size:24px;color:blue;"></i> 
        <i class="fa fa-toggle-down " id = "close2" onclick=closePanel2(); style="font-size:24px;color:blue; display:none;" ></i> 
        <h4 style = 'color:black;display:inline;'>Sinov labalatoriyasi xulosasi</h4>
       
        <div class="row" id="content2" style = "display:none">
        <?php foreach ($labs as $key => $stan) :?>        
                     <div class="col-md-6 col-lg-9">
                        <label>Mahsulot nomi:</label>
                            <label class="form-control" readonly><?= $stan['product_name'] ?></label>
                        <?= $form->field($stan, "[{$key}]product_id")->hiddenInput(['value'=> $stan['product_id']])->label(false);?>
                     </div>
                        <div class="col-md-6 col-lg-4">
                            <?= $form->field($stan, "[{$key}]quality")->radioList( 
                                [1=>'Sifatli', 0 => 'Sifatsiz',2=>'Tekshirish jarayonida'], );?>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <?= $form->field($stan, "[{$key}]description")->textarea() ?>
                        </div>   
                    <?php endforeach; ?>
            </div>
        </div>
<div style = "padding-top:20px">
    <i class="fa fa-toggle-right" id = "open3" onclick=openPanel3(); style="font-size:24px;color:blue;"></i> 
    <i class="fa fa-toggle-down " id = "close3" onclick=closePanel3(); style="font-size:24px;color:blue; display:none;" ></i> 
    <h4 style = "color:black;display:inline;">Majburiy sertifikatlashtirish</h4>
    <div id = "content3" class = "row" style = "display:none">
        <?php foreach ($certificates as $key => $stan) :?>        
                  <div class="row">
                     <div class="col-md-6 col-lg-9">
                        <label>Mahsulot nomi:</label>
                        <label class="form-control" readonly><?= $stan['product_name'] ?></label>
                     </div>
                </div>   
                <?php for($i = 0; $i < $stan['certificate']; $i++) :?> 
                    <div class="row">
                        <?php if ($i == 0) :?>
                        <div class="col-md-6 col-lg-6">   
                            <?= $form->field($stan[$i], "[{$key}]product_id")->hiddenInput(['value'=> $stan['product_id']])->label(false);?>
                        </div>
                        <div class="col-md-6 col-lg-6">  
                            <?= $form->field($stan[$i], "[{$key}]certificate")->hiddenInput(['value'=> $stan['certificate']])->label(false);?>  
                        </div>       
                        <div class="col-md-6 col-lg-6">
                            <?= $form->field($stan[$i], "[{$key}]amount")->textInput(['type'=>'number']) ?>
                        </div> 
                        <div class="col-md-6 col-lg-6">
                            <?= $form->field($stan[$i], "[{$key}]quantity")->textInput(['type'=>'number']) ?>
                        </div> 
                        <?php endif; ?>
                        <div><h4><?=$i+1?>-sertifikat</h4></div>  
                         <div> 
                            <?= $form->field($stan[$i], "[{$key}][{$i}]product_id")->hiddenInput(['value'=> $stan['product_id']])->label(false);?>
                         </div> 
                         <div class="col-md-6 col-lg-4">
                            <?= $form->field($stan[$i], "[{$key}][{$i}]number_reestr")->textInput(['type' => 'number']) ?>
                         </div> 
                         <div class="col-md-6 col-lg-4">
                            <?= $form->field($stan[$i], "[{$key}][{$i}]date_to")->textInput(['type'=>'date']) ?>
                        </div> 
                        <div class="col-md-6 col-lg-4">
                            <?= $form->field($stan[$i], "[{$key}][{$i}]date_from")->textInput(['type'=>'date']) ?>
                        </div> 
                    </div> 
                    <?php endfor; ?>
                <?php endforeach; ?>
            </div>
    </div>
    <div class="col-12" style = "padding-top:20px">
        <input type="submit" class="btn btn-info br-btn" value="Saqlash">
    </div>

    <?php ActiveForm::end() ?>

</div>
<script>
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
function openPanel3() {

var  item1 = document.getElementById('open3');
var  item2 = document.getElementById('close3');
var item3 = document.getElementById('content3');

item1.style.display = 'none';
item2.style.display = 'inline';
item3.style.display = 'flex'


}
function closePanel3() {

var  item1 = document.getElementById('open3');
var  item2 = document.getElementById('close3');
var item3 = document.getElementById('content3');

item1.style.display = 'inline';
item2.style.display = 'none';
item3.style.display = 'none'

}
</script>

