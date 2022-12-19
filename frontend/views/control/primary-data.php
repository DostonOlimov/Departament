<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */

/* @var $model PrimaryData */

use common\models\control\PrimaryData;
use common\models\control\PrimaryOv;
use common\models\control\PrimaryProduct;
use common\models\types\ProductSector;
use common\models\control\PrimaryProductNd;
use common\models\control\ControlProductCertification;
use common\models\Countries;
use kartik\date\DatePicker;
use frontend\widgets\Steps;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\widgets\ActiveForm;
use kartik\depdrop\DepDrop;
use kartik\money\MaskMoney;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Birlamchi ma`lumotlar';
$this->params['breadcrumbs'][] = $this->title;
$codetnved = [];
?>

    <div class="page1-1 row">

        <?= Steps::widget([
            'control_instruction_id' => $model->controlCompany->controlInstruction->id,
            'control_company_id' => $model->control_company_id,
        ]) ?>

        <?php $form = ActiveForm::begin([
            'id' => 'dynamic-form',
            'enableClientValidation' => false,
        ]) ?>
        
            <i class="fa fa-toggle-right" id = "open1" onclick=openPanel(); style="font-size:24px;color:blue;display:none;"></i> 
            <i class="fa fa-toggle-down " id = "close1" onclick=closePanel(); style="font-size:24px;color:blue; " ></i> 
            <h3 style="color:black; display:inline;" >Tashkilotga oid malumotlar</h3>
                <hr>
                        <div class="row" id="content1">
                            <div class="col-sm-6">
                                <?= $form->field($model, 'smt')->dropDownList(PrimaryData::getSMT(),['prompt'=>'- - -']) ?>
                            </div>

                            <div class="col-sm-6">
                                <?= $form->field($model, 'laboratory')->dropDownList(PrimaryData::getLab(),['prompt'=>'- - -']) ?>
                            </div>
                        </div>
    
            <i class="fa fa-toggle-right" id = "open2" onclick=openPanel2(); style="font-size:24px;color:blue;display:none;"></i> 
            <i class="fa fa-toggle-down " id = "close2" onclick=closePanel2(); style="font-size:24px;color:blue; " ></i> 
            <h3 style="color:black;display:inline;">Tashkolotda mavjud o'lchov vositalari haqida ma'lumot</h3>
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
                                    <div class="clearfix"></div>
                                </div>
                                <div class="panel-body">
                                    <div class="row ">
                                        <div class="col-md-6 col-lg-3">
                                            <?= $form->field($stan, "[{$i}]type")->dropDownList(PrimaryOv::getType(),['prompt'=>'- - -']) ?>
                                        </div>
                                        <div class="col-md-6 col-lg-3">
                                            <?= $form->field($stan, "[{$i}]measurement")->textInput(['type' => 'number']) ?>
                                        </div>
                                        <div class="col-md-6 col-lg-3">
                                            <?= $form->field($stan, "[{$i}]compared")->textInput(['type' => 'number']) ?>
                                        </div>
                                        <div class="col-md-6 col-lg-3">
                                            <?= $form->field($stan, "[{$i}]invalid")->textInput(['type' => 'number']) ?>
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
        <i class="fa fa-toggle-right" id = "open3" onclick=openPanel3(); style="font-size:24px;color:blue;display:none;"></i> 
        <i class="fa fa-toggle-down " id = "close3" onclick=closePanel3(); style="font-size:24px;color:blue; " ></i> 
        <h3 style="color:black;display:inline;">Tashkilotda tekshiruv davrida realizatsiya qilingan mahsulotlar haqida ma'lumot</h3>
        <hr>
        <div class="row mt-3" id="content3" >
            <div class="box box-default" style="display: inline-block">
                <div class="panel-body">
                    <?php DynamicFormWidget::begin([
                        'widgetContainer' => 'dynamicform_wrapper_2', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                        'widgetBody' => '.container-items_2', // required: css class selector
                        'widgetItem' => '.item_2', // required: css class
//                        'limit' => 7, // the maximum times, an element can be cloned (default 999)
                        'min' => 1, // 0 or 1 (default 1)
                        'insertButton' => '.add-item_2', // css class
                        'deleteButton' => '.remove-item_2', // css class
                        'model' => $product[0],
                        'formId' => 'dynamic-form',
                        'formFields' => [
                            'sector_id',
                            'group',
                            'position',
                            'subposition',
                            'class',
                            'made_country',
                            'product_measure',
                            'product_purpose',
                            'select_of_exsamle_purpose',
                            'mandatory_certificate_id',
                            'product_name',
                            'residue_quantity',
                            'residue_amount',
                            'year_amount',
                            'year_quantity',
                            'potency',
                        ],
                    ]); ?>

                    <div class="container-items_2">
                        <?php foreach ($product as $i => $stan):
                           // $stan->category = PrimaryDataForm::CATEGORY_PRODUCT;
                            if ($i == 1) {
                               continue;
                             }
                            
                            ?>
                            <div class="item_2 panel panel-default item-product itemlar">
                                <div class="panel-heading">
                                    <div class="pull-right">
                                        <button type="button" class="add-item_2 btn btn-success btn-xs"><i class="fa fa-plus"></i></button>
                                        <button type="button" class="remove-item_2 btn btn-danger btn-xs" id="removeBtn"><i class="fa fa-minus"></i></button>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-3 categoriya" style="display: none;">
                                            <?php

                                           // echo $form->field($stan, "[{$i}]category")->dropDownList(PrimaryDataForm::categoryList())
                                            ?>
                                        </div>
                                        <div class="col-md-6 col-lg-3 ">
                                            <?= $form->field($stan, "[{$i}]product_name")->textInput() ?>
                                        </div>
                                        <div class="col-md-6 col-lg-3" >
                                            <?= $form->field($stan, "[{$i}]made_country")->dropDownList(ArrayHelper::map(Countries::find()->all(), 'id', 'name',),['prompt'=>'- - -']) ?>
                                        </div>
                                        <div class="col-md-6 col-lg-3">
                                            <?= $form->field($stan, "[{$i}]product_measure")->dropDownList(PrimaryProduct::getMeasure(),['prompt'=>'- - -']) ?>
                                        </div>
                                        <div class="col-md-6 col-lg-3">
                                            <?= $form->field($stan, "[{$i}]sector_id")->dropDownList(ArrayHelper::map(ProductSector::find()->orderBy('name', 'ASC')->asArray()->all(), 'id', 'name'),['prompt'=>'- - -']) ?>
                                        </div>
                                        <div class="col-md-6 col-lg-3">
                                            <?php
                                            
                                            echo $form->field($stan, "[{$i}]group")->widget(DepDrop::classname(), [

                                                'pluginOptions'=>[
                                                    'depends'=>[Html::getInputId($stan, "[{$i}]sector_id")], // the id for cat attribute
                                                    'placeholder'=>'- - -',
                                                    'url'=>Url::to(['/control/group'])
                                                ]
                                            ]);?>
                                        </div>
                                        <div class="col-md-6 col-lg-3">
                                            <?php
                                            echo $form->field($stan, "[{$i}]class")->widget(DepDrop::classname(), [

                                                'pluginOptions'=>[
                                                    'depends'=>[Html::getInputId($stan, "[{$i}]group")], // the id for cat attribute
                                                    'placeholder'=>'- - -',
                                                    'url'=>Url::to(['/control/class'])
                                                ]
                                            ]);?>
                                        </div>
                                        <div class="col-md-6 col-lg-3">
                                            <?php
                                            echo $form->field($stan, "[{$i}]position")->widget(DepDrop::classname(), [

                                                'pluginOptions'=>[
                                                    'depends'=>[Html::getInputId($stan, "[{$i}]class")], // the id for cat attribute
                                                    'placeholder'=>'- - -',
                                                    'url'=>Url::to(['/control/position'])
                                                ]
                                            ]);?>
                                        </div>
                                        <div class="col-md-6 col-lg-3">
                                            <?php
                                            echo $form->field($stan, "[{$i}]subposition")->widget(DepDrop::classname(), [

                                                'pluginOptions'=>[
                                                    'depends'=>[Html::getInputId($stan, "[{$i}]position")], // the id for cat attribute
                                                    'placeholder'=>'- - -',
                                                    'url'=>Url::to(['/control/subposition'])
                                                ]
                                            ]);?>
                                        </div>     
                                       <div class="col-md-6 col-lg-6  renderForm">
                                            <?php
                                            echo $this->render('_form_primary', [
                                                'form' => $form,
                                                'primaryIndex' => $i,
                                                'pro_primary' => !isset($pro_primary[$i]) ? [new PrimaryProductNd] : $pro_primary[$i],
                                            ])
                                            ?>
                                        </div>
                                        <div class="col-md-6 col-lg-3">
                                             <?= $form->field($stan, "[{$i}]labaratory_checking")->radioList( [1=>'taqdim etilgan', 0 => 'taqdim etilmagan'] );?>
                                        </div>
                                    
                                        <div class="col-md-6 col-lg-3">
                                            <?= $form->field($stan, "[{$i}]residue_quantity")->widget(MaskMoney::classname(), [
                                                 'pluginOptions' => [
                                            'prefix' => 'SUMMA : ',
                                            'suffix' => ' so\'m',
                                            'allowNegative' => false ]
                                            ]); ?>
                                        </div>
                                        <div class="col-md-6 col-lg-3">
                                            <?= $form->field($stan, "[{$i}]residue_amount")->textInput(['type' => 'number']) ?>
                                        </div>
                                        <div class="col-md-6 col-lg-3">
                                            <?= $form->field($stan, "[{$i}]year_amount")->textInput(['type' => 'number']) ?>
                                        </div>
                                        <div class="col-md-6 col-lg-3">
                                            <?= $form->field($stan, "[{$i}]year_quantity")->widget(MaskMoney::classname(), [
                                                'pluginOptions' => [
                                            'prefix' => 'SUMMA : ',
                                            'suffix' => ' so\'m',
                                            'allowNegative' => false
                                            ]
                                            ]);  ?>
                                        </div>
                                        <div class="col-md-6 col-lg-3">
                                            <?= $form->field($stan, "[{$i}]potency")->textInput() ?>
                                        </div>
                                   
                                    <div class="col-md-6 col-lg-3" >
                                    <?= $form->field($stan, "[{$i}]certification")->radioList( [1=>'ha', 0 => 'yo\'q'], );?>
                                    </div>
                                    <div class="col-md-6 col-lg-3">
                                     <?= $form->field($stan, "[{$i}]photo")->fileInput() ?>
                                    </div>
                                    <div class="col-md-6 col-lg-3">
                                    <?= $form->field($stan, "[{$i}]exsist_certificate")->radioList( [1=>'mavjud', 0 => 'mavjud emas'],['onclick' => "typeChange(event,this)",] );?>
                                    </div>
                                    <div class="col-md-6 col-lg-3">
                                      <?= $form->field($stan, "[{$i}]codetnved")->textInput(['type' => 'number']) ?>
                                     </div>
                                    <div class="col-md-6 col-lg-9  renderForm certificate" style="display:none;">
                                            <?php
                                            echo $this->render('_form_certification', [
                                                'form' => $form,
                                                'primaryIndex' => $i,
                                                'pro_cer' => !isset($pro_cer[$i]) ? [new ControlProductCertification] : $pro_cer[$i],
                                            ])
                                            ?>
                                        </div>
                                   <!-- <button type="button" onclick="myFunction(this)" class=" add-item3 btn btn-success btn-sm pull-right"><i class="glyphicon glyphicon-plus"></i> Majburiy</button>
                                    </h4>

                                        <div class="pull-right">
                                            <button type="button"  onclick = "myFunction1(this)" class="remove-item3 btn btn-danger btn-xs mandatory" style="display: none">
                                                <i class="glyphicon glyphicon-minus" ></i>Majburiy emas</button>
                                        </div>-->
                                   
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <?php DynamicFormWidget::end(); ?>
                </div>
            </div>
        </div>
 <div class="col-12" style="margin-top:15px">
            <input type="submit" class="btn btn-info br-btn" value="Saqlash">
        </div>
        <?php ActiveForm::end() ?>

    </div>
    
<?php
/*
$script = "
$(function(){
	// $('.select2:not(:hidden)').select2();
	// $('a[data-toggle=tab]').on('shown.bs.tab', function (e) {
	// 	$('.select2').select2();
	// });
	$('.select2222').select2({
		minimumInputLength: 2,
		ajax: {
			url: '".Url::to(['/control/code-tn-ved'])."',
			type: 'GET',
			dataType: 'json',
			data: function (params)
			{
				var jsonObj = {
					term: params.term
				};
				jsonObj['$csrf_param'] = '$csrf_token';
				return jsonObj;
			},
			processResults: function (data, params)
			{
				console.log(data);
				return {
					results: data
				};
			}
		}
	});
});
";

$this->registerJs($script);
*/
?>
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
   /* function myFunction(button) {
    alert(button);
        obj = findParent(button, 'panel-body');

       var collection =  obj.getElementsByClassName("certificate");
       for (var i=0;i<collection.length;i++)
       { ;
           collection[i].style.display = 'none';
       }

    }*/
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
