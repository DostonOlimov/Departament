<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */

/* @var $model PrimaryData */

use common\models\control\PrimaryData;
use common\models\control\PrimaryOv;
use common\models\control\PrimaryProduct;
use common\models\types\ProductSector;
use common\models\control\PrimaryProductNd;
use common\models\Countries;
use kartik\date\DatePicker;
use frontend\widgets\Steps;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
use kartik\money\MaskMoney;
use yii\helpers\Html;

$this->title = 'Birlamchi ma`lumotlar';
$this->params['breadcrumbs'][] = $this->title;
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

        <div class="row">
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
                        <h3 style="color:black;">Tashkilotga oid malumotlar</h3>
                        <hr>
                        <div class="row">
                            <div class="col-sm-6">
                                <?= $form->field($model, 'smt')->dropDownList(PrimaryData::getSMT(),['prompt'=>'Tanlash...']) ?>
                            </div>

                            <div class="col-sm-6">
                                <?= $form->field($model, 'laboratory')->dropDownList(PrimaryData::getLab(),['prompt'=>'Tanlash...']) ?>
                            </div>
                        </div>

                        <h3 style="color:black;">Tashkolotda mavjud o'lchov vositalari haqida ma'lumot</h3>
                        <hr>
                        <?php
                        foreach ($ov as $i => $stan):
                            if ($i == 1) {
                                continue;
                            } ?>
                            <div class="item panel panel-default item-product itemlar">
                                <div class="panel-heading">

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
                                    <div class="row">
                                        <div class="col-md-6 col-lg-3">
                                            <?= $form->field($stan, "[{$i}]type")->dropDownList(PrimaryOv::getType(),['prompt'=>'Tanlash...']) ?>
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

        <h3 style="color:black;">Tashkilotda tekshiruv davrida realizatsiya qilingan mahsulotlar haqida ma'lumot</h3>
        <hr class="mt-3 mb-3">
        <div class="row mt-3">
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
                                        <div class="col-md-6 col-lg-3">
                                            <?= $form->field($stan, "[{$i}]sector_id")->dropDownList(ArrayHelper::map(ProductSector::find()->orderBy('name', 'ASC')->asArray()->all(), 'id', 'name'),['prompt'=>'Tanlash...']) ?>
                                        </div>
                                        <div class="col-md-6 col-lg-3">
                                            <?php
                                            echo $form->field($stan, "[{$i}]group")->widget(DepDrop::classname(), [

                                                'pluginOptions'=>[
                                                    'depends'=>[Html::getInputId($stan, "[{$i}]sector_id")], // the id for cat attribute
                                                    'placeholder'=>'Tanlash...',
                                                    'url'=>Url::to(['/control/group'])
                                                ]
                                            ]);?>
                                        </div>
                                        <div class="col-md-6 col-lg-3">
                                            <?php
                                            echo $form->field($stan, "[{$i}]class")->widget(DepDrop::classname(), [

                                                'pluginOptions'=>[
                                                    'depends'=>[Html::getInputId($stan, "[{$i}]group")], // the id for cat attribute
                                                    'placeholder'=>'Tanlash...',
                                                    'url'=>Url::to(['/control/class'])
                                                ]
                                            ]);?>
                                        </div>
                                        <div class="col-md-6 col-lg-3">
                                            <?php
                                            echo $form->field($stan, "[{$i}]position")->widget(DepDrop::classname(), [

                                                'pluginOptions'=>[
                                                    'depends'=>[Html::getInputId($stan, "[{$i}]class")], // the id for cat attribute
                                                    'placeholder'=>'Tanlash...',
                                                    'url'=>Url::to(['/control/position'])
                                                ]
                                            ]);?>
                                        </div>
                                        <div class="col-md-6 col-lg-3">
                                            <?php
                                            echo $form->field($stan, "[{$i}]subposition")->widget(DepDrop::classname(), [

                                                'pluginOptions'=>[
                                                    'depends'=>[Html::getInputId($stan, "[{$i}]position")], // the id for cat attribute
                                                    'placeholder'=>'Tanlash...',
                                                    'url'=>Url::to(['/control/subposition'])
                                                ]
                                            ]);?>
                                        </div>
                                            <div class="col-md-6 col-lg-3 ">
                                            <?= $form->field($stan, "[{$i}]product_name")->textInput() ?>
                                        </div>
                                        <div class="col-md-6 col-lg-3" >
                                            <?= $form->field($stan, "[{$i}]made_country")->dropDownList(ArrayHelper::map(Countries::find()->all(), 'id', 'name',),['prompt'=>'Tanlash...']) ?>
                                        </div>
                                        <div class="col-md-6 col-lg-3">
                                            <?= $form->field($stan, "[{$i}]select_of_exsamle_purpose")->dropDownList(PrimaryProduct::getPurpose(),['prompt'=>'Tanlash...']) ?>
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
                                            <?= $form->field($stan, "[{$i}]product_measure")->dropDownList(PrimaryProduct::getMeasure(),['prompt'=>'Tanlash...']) ?>
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


                                    <h4 style="color:black;>
            <i class="glyphicon glyphicon-envelope" ></i> Majburiy Sertifikatlashtirish
                                    <button type="button" onclick="myFunction(this)" class=" add-item3 btn btn-success btn-sm pull-right"><i class="glyphicon glyphicon-plus"></i> Majburiy</button>
                                    </h4>

                                        <div class="pull-right">
                                            <button type="button"  onclick = "myFunction1(this)" class="remove-item3 btn btn-danger btn-xs mandatory" style="display: none">
                                                <i class="glyphicon glyphicon-minus" ></i>Majburiy emas</button>
                                        </div>
                                    <div class="col-sm-3 mandatory"  style="display: none">
                                        <?= $form->field($stan, "[{$i}]number_reestr")->textInput() ?>
                                    </div>
                                    <div class="col-sm-3 mandatory" style="display: none">
                                        <?= $form->field($stan, "[{$i}]number_blank")->textInput() ?>
                                    </div>  <div class="col-sm-3  mandatory" style="display: none">
                                        <?= $form->field($stan, "[{$i}]date_to")->widget(DatePicker::className()) ?>
                                    </div>
                                    <div class="mandatory col-sm-3 " style="display: none">
                                        <?= $form->field($stan, "[{$i}]date_from")->widget(DatePicker::className()) ?>
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



        <div class="col-12" style="margin-top:15px">
            <input type="submit" class="btn btn-info br-btn" value="Saqlash">
        </div>
        <?php ActiveForm::end() ?>

    </div>
<script>
    function myFunction(button) {

        obj = findParent(button, 'panel-body');

       var collection =  obj.getElementsByClassName("mandatory");
       for (var i=0;i<collection.length;i++)
       {
           collection[i].style.display = 'inline-block';
       }

    }

    function findParent(elem, className){
        if (elem.parentNode.classList.contains(className)){
            return elem.parentNode;
        }

        return findParent(elem.parentNode,className);

    }
    function myFunction1(button) {
        obj = findParent(button, 'panel-body');

        var collection =  obj.getElementsByClassName("mandatory");
        for (var i=0;i<collection.length;i++)
        {
            collection[i].style.display = 'none';
        }

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
