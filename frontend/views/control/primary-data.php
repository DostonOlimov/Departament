<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */

/* @var $model PrimaryData */

use common\models\control\ControlPrimaryOvNd;
use common\models\control\PrimaryData;
use common\models\control\PrimaryOv;
use common\models\control\PrimaryProduct;
use common\models\types\ProductSector;
use common\models\control\PrimaryProductNd;
use common\models\control\ControlProductCertification;
use common\models\Countries;
use frontend\assets\AppAsset;
use frontend\widgets\Steps;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\widgets\ActiveForm;
use kartik\depdrop\DepDrop;
use kartik\money\MaskMoney;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\MaskedInput;

$this->title = 'Birlamchi ma`lumotlar';
$this->params['breadcrumbs'][] = $this->title;
$codetnved = [];

AppAsset::register($this);
?>
    <div class="page1-1 row">

        <?= Steps::widget([
            'control_instruction_id' => $model->controlCompany->controlInstruction->id,
            'control_company_id' => $model->control_company_id,
        ]) ?>

        <?php $form = ActiveForm::begin([
            'id' => 'dynamic-form',
            'enableClientValidation' => false,
            'options' => [
                'enctype' => 'multipart/form-data',
                'id' => 'dynamic-form'
            ]
        ]) ?>

            <i class="fa fa-toggle-right openPanel" id = "open1" onclick=openPanel(); style="display: none"></i> 
            <i class="fa fa-toggle-down closePanel" id = "close1" onclick=closePanel(); ></i> 
            <h3>Tashkilotga oid ma'lumotlar</h3>
                <hr>
                    <div class="row" id="content1">
                        <div class="col-sm-6">
                            <?= $form->field($model, 'smt')->dropDownList(PrimaryData::getSMT(),['prompt'=>'- - -']) ?>
                        </div>
                        <div class="col-sm-6">
                            <?= $form->field($model, 'laboratory')->dropDownList(PrimaryData::getLab(),['prompt'=>'- - -']) ?>
                        </div>
                        <div class="col-sm-6">
                            <?= $form->field($model, 'repeat_instruction')->dropDownList(PrimaryData::getRepeat(),['prompt'=>'- - -','onchange'=>'getRepeat(event)']) ?>
                        </div>
                        <div class="col-sm-6" style = "display:none" id = "repeat">
                            <?= $form->field($model, 'repeat_comment')->textarea(['rows' => 6]) ?>
                        </div>
                    </div>
                    
<?php if($type->ov == 1) : ?>
    <div id = "ov">            
        <i class="fa fa-toggle-right openPanel" id = "open2" onclick=openPanel2(); style="display:none;"></i> 
        <i class="fa fa-toggle-down closePanel " id = "close2" onclick=closePanel2(); ></i> 
        <h3 >Tashkilotda mavjud o'lchov vositalari haqida ma'lumot</h3>
        <hr>
        <div class="row" id="content2"  >
            <div class="box box-default" style="display: inline-block">
                <div class="panel-body">
                    <?php DynamicFormWidget::begin([
                        'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                        'widgetBody' => '.container-items', // required: css class selector
                        'widgetItem' => '.item', // required: css class
//                        'limit' => 7, // the maximum times, an element can be cloned (default 999)
                        'min' => 1, // 0 or 1 (default 1)
                        'insertButton' => '.add-item', // css class
                        'deleteButton' => '.remove-item', // css class
                        'model' => $ov[0],
                        'formId' => 'dynamic-form',
                        'formFields' => [
                            'type',
                            'measurement',
                            'compared',
                            'invalid',
                        ],
                    ]); ?>
                <div class="container-items">        
                        <?php
                        foreach ($ov as $i => $stan):
                            if ($i == 1) {
                                continue;
                            } ?>
                            <div class="item panel panel-default item-product itemlar"  >
                                <div class="panel-heading" >
                                    <div class="pull-right">
                                        <button type="button" class="add-item btn btn-success btn-xs">
                                            <i class="fa fa-plus"></i></button>
                                        <button type="button" class="remove-item btn btn-danger btn-xs" id="removeBtn">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="row ">
                                        <div class="col-md-6 col-lg-3" id="titleOv">
                                            <?= $form->field($stan, "[{$i}]type")->dropDownList(PrimaryOv::getType(),['prompt'=>'- - -']) ?>
                                        </div>
                                        <div class="col-md-6 col-lg-2">
                                            <?= $form->field($stan, "[{$i}]measurement")->textInput(['type' => 'number']) ?>
                                        </div>
                                        <div class="col-md-6 col-lg-2">
                                            <?= $form->field($stan, "[{$i}]compared")->textInput(['type' => 'number']) ?>
                                        </div>
                                        <div class="col-md-6 col-lg-2">
                                            <?= $form->field($stan, "[{$i}]invalid")->textInput(['type' => 'number']) ?>
                                        </div>
                                        <div class="col-md-6 col-lg-3">
                                            <?= $form->field($stan, "[{$i}]uncompared")->textInput(['type' => 'number']) ?>
                                        </div>
                                        <div class="col-md-6 col-lg-6  renderForm">
                                            <?php
                                            echo $this->render('_form_nd_ovs', [
                                                'form' => $form,
                                                'primaryIndex' => $i,
                                                'pro_ovs' => !isset($pro_ovs[$i]) ? [new ControlPrimaryOvNd()] : $pro_ovs[$i],
                                            ])
                                            ?>
                                        </div>
                                        <div class="col-md-6 col-lg-3">
                                            <?= $form->field($stan, "[{$i}]unworked")->textInput(['type' => 'number']) ?>
                                        </div>
                                        <div class="col-md-6 col-lg-3">
                                            <?= $form->field($stan, "[{$i}]expired")->textInput(['type' => 'number']) ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <?php DynamicFormWidget::end(); ?>
                </div>
            </div>
        </div>
    </div>
<?php endif;  
if($type->document == 1) : ?>
    <div id = "document">
        <i class="fa fa-toggle-right openPanel" id = "open4" onclick=openPanel4(); style="display:none;"></i> 
        <i class="fa fa-toggle-down closePanel " id = "close4" onclick=closePanel4(); ></i> 
        <h3>Hujjat tahlili</h3>
        <hr>
        <div class="row" id="content4"  >
            <div class="box box-default" style="display: inline-block">
                <div class="panel-body">
                    <?php DynamicFormWidget::begin([
                        'widgetContainer' => 'dynamicform_wrapper_3', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                        'widgetBody' => '.container-items_3', // required: css class selector
                        'widgetItem' => '.item_3', // required: css class
//                        'limit' => 7, // the maximum times, an element can be cloned (default 999)
                        'min' => 1, // 0 or 1 (default 1)
                        'insertButton' => '.add-item_3', // css class
                        'deleteButton' => '.remove-item_3', // css class
                        'model' => $document[0],
                        'formId' => 'dynamic-form',
                        'formFields' => [
                            'reestr_number',
                            'given_date',
                            'defect',
                        ],
                    ]); ?>
                <div class="container-items_3">        
                        <?php
                        foreach ($document as $i => $stan):
                            if ($i == 1) {
                                continue;
                            } ?>
                            <div class="item_3 panel panel-default item-product itemlar"  >
                                <div class="panel-heading" >
                                    <div class="pull-right">
                                        <button type="button" class="add-item_3 btn btn-success btn-xs">
                                            <i class="fa fa-plus"></i></button>
                                        <button type="button" class="remove-item_3 btn btn-danger btn-xs" id="removeBtn">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="row ">
                                        <div class="col-md-6 col-lg-4">
                                            <?= $form->field($stan, "[{$i}]reestr_number")->textInput() ?>
                                        </div>
                                        <div class="col-md-6 col-lg-4">
                                            <?= $form->field($stan, "[{$i}]given_date")->textInput(['type' => 'date']) ?>
                                        </div>
                                        <div class="col-md-6 col-lg-4">
                                            <?= $form->field($stan, "[{$i}]defect")->textInput([]) ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <?php DynamicFormWidget::end(); ?>
                </div>
            </div>
        </div>
    </div>
    <?php endif;  ?>
    <div class="col-12" style="margin-top:15px">
        <input type="submit" class="btn btn-info br-btn" value="Saqlash">
    </div>
        <?php ActiveForm::end() ?>
    </div>

<script >
    
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
            collection[i].style.display = 'block';
        }
        }
        if (e.target.value == "0" && e.target.checked) {
            let inputs = obj.getElementsByClassName('certificate');
            for (let i = 0; i < inputs.length; i++) {
                inputs[i].style.display = 'none';
            }
        }
    }

    function getOv(e) {
        if(e.target.checked && e.target.value == 1)
        {
            var  item = document.getElementById('ov');
            item.style.display = 'none';
        }
        if(e.target.checked && e.target.value == 0)
        {
            var  item = document.getElementById('ov');
            item.style.display = 'block'
        }
        
 
}
function getRepeat(e) {
   // alert(e.target.selected);
        if(e.target.value == 0)
        {
            var  item = document.getElementById('repeat');
            item.style.display = 'none';
        }
        if( e.target.value == 1)
        {
            var  item = document.getElementById('repeat');
            item.style.display = 'block'
        }
    }
function getProduct(e) {
        if(e.target.checked && e.target.value == 1)
        {
            var  item = document.getElementById('product');
            item.style.display = 'none';
        }
        if(e.target.checked && e.target.value == 0)
        {
            var  item = document.getElementById('product');
            item.style.display = 'block'
        }
    }
function getDocument(e) {
        if(e.target.checked && e.target.value == 1)
        {
            var  item = document.getElementById('document');
            item.style.display = 'none';
        }
        if(e.target.checked && e.target.value == 0)
        {
            var  item = document.getElementById('document');
            item.style.display = 'block'
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
function openPanel4() {

var  item1 = document.getElementById('open4');
var  item2 = document.getElementById('close4');
var item3 = document.getElementById('content4');

item1.style.display = 'none';
item2.style.display = 'inline';
item3.style.display = 'flex'

}
function closePanel4() {

var  item1 = document.getElementById('open4');
var  item2 = document.getElementById('close4');
var item3 = document.getElementById('content4');

item1.style.display = 'inline';
item2.style.display = 'none';
item3.style.display = 'none'

}
    </script>
<?php

$this->registerJs("	
	
	$('.dynamicform_wrapper').on('beforeInsert', function(e, item) {
	});
	var count =0
	$('.dynamicform_wrapper').on('afterInsert', function(e, item) {
        if($('.categoriya')[$('.categoriya').length-2].children[0].children[1].value=='2'){     
                console.log($('.categoriya')[$('.categoriya').length-2].children[0].children[1].value)
            var categories = $('.categoriya')[$('.categoriya').length-1].parentElement.children
 
            for(let i = 0; i<9; i++){
                if(i==0){
                categories[i].children[0].children[1].value='2'      
                 
                categories[i].children[0].children[1].style.display = 'none'    
               
                }else {
                categories[i].style.display = 'block'
                }		
            }
          
            for(let i =9 ;i<categories.length;i++){		
                 categories[i].style.display = 'none'                 
            }
            
        }
        //else {
//            for(let i = 0; i < 8; i++){
//                if(i==0){
//                categories[i].children[0].children[1].value='1'
//                categories[i].children[0].children[1].style.display = 'none'    
//                }else {         
//                categories[i].style.display = 'none'
//                }
//            }
//            for(let i =8 ;i<categories.length;i++){
//                categories[i].style.display = 'block'
//            }
    //    }
	
	});

	$('.dynamicform_wrapper').on('beforeDelete', function(e, item) {
		
	});

	$('.dynamicform_wrapper').on('afterDelete', function(e) {
		$('.dynamicform_wrapper .panel-title').each(function(index) {
			$(this).html('Стандарт: ' + (index + 1));
		});
	});
");
?>
