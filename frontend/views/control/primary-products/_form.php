<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\control\PrimaryProduct;
use common\models\types\ProductSector;
use common\models\NdType;
use common\models\Countries;
use kartik\depdrop\DepDrop;
use kartik\money\MaskMoney;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\widgets\MaskedInput;
use wbraganca\dynamicform\DynamicFormWidget;
use common\models\types\ProductClass;
use common\models\types\ProductGroup;
use common\models\types\ProductPosition;
use common\models\types\ProductSubposition;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\control\PrimaryProduct $model */
/** @var yii\widgets\ActiveForm $form */
$group = '';
$class = '';
$position = '';
$subposition = '';
if(ProductGroup::findOne(['kode'=>$model->group])){
    $group = ProductGroup::findOne(['kode'=>$model->group])->name;
}
if(ProductClass::findOne(['kode'=>$model->class])){
    $class = ProductClass::findOne(['kode'=>$model->class])->name;
}
if(ProductPosition::findOne(['kode'=>$model->position])){
    $position = ProductPosition::findOne(['kode'=>$model->position])->name;
}
if(ProductSubposition::findOne(['kode'=>$model->subposition])){
    $subposition = ProductSubposition::findOne(['kode'=>$model->subposition])->name;
}
?>
<style>
    .openPanel{
    font-size:32px;
    color:green;
}
.closePanel{
    font-size:32px;
    color:red;
    
}

</style>

<div id="content">
    <?php $form = ActiveForm::begin([
            'id' => 'dynamic-form',
            'enableClientValidation' => false,
            'options' => [
                'enctype' => 'multipart/form-data',
                'id' => 'dynamic-form'
            ]
        ]); 
    $model->product_type = '0';?>
  
<div class="row" id="product">
<?= $form->field($model, 'product_type')->hiddenInput()->label(false); ?>
   <?= $form->field($model, 'control_primary_data_id')->hiddenInput()->label(false);?>
    <div class="col-md-6 col-lg-3 ">
        <?= $form->field($model, "product_name")->textInput() ?>
    </div>
    <div class="col-md-6 col-lg-3" >
        <?= $form->field($model, "made_country")->dropDownList(ArrayHelper::map(Countries::find()->all(), 'id', 'name',),['prompt'=>'- - -']) ?>
    </div>
    <div class="col-md-6 col-lg-3">
        <?= $form->field($model, "product_measure")->dropDownList(PrimaryProduct::getMeasure(),['prompt'=>'- - -']) ?>
    </div>
    <div class="col-md-6 col-lg-3">
        <?= $form->field($model, "sector_id")->dropDownList(ArrayHelper::map(ProductSector::find()->orderBy('name', 'ASC')->asArray()->all(), 'id', 'name'),['prompt'=>'- - -']) ?>
    </div>
    <div class="col-md-6 col-lg-3">
        <?= $form->field($model, "group")->widget(DepDrop::classname(), [
            'data'=>[$model->group => $group],
            'pluginOptions'=>[
            'depends'=>[Html::getInputId($model, "sector_id")], // the id for cat attribute
            'placeholder'=>'- - -',
            'url'=>Url::to(['/control/primary-products/group'])
                ]
        ]);?>
    </div>
    <div class="col-md-6 col-lg-3">
        <?= $form->field($model, "class")->widget(DepDrop::classname(), [
            'data'=>[$model->class => $class],
            'pluginOptions'=>[
            'depends'=>[Html::getInputId($model, "group")], // the id for cat attribute
            'placeholder'=>'- - -',
            'url'=>Url::to(['/control/primary-products/class'])
                ]
            ]);?>
    </div>
    <div class="col-md-6 col-lg-3">
        <?= $form->field($model, "position")->widget(DepDrop::classname(), [
            'data'=>[$model->position => $position],
            'pluginOptions'=>[
            'depends'=>[Html::getInputId($model, "class")], // the id for cat attribute
            'placeholder'=>'- - -',
            'url'=>Url::to(['/control/primary-products/position'])
                ]
            ]);?>
    </div>
    <div class="col-md-6 col-lg-3">
        <?= $form->field($model, "subposition")->widget(DepDrop::classname(), [
            'data'=>[$model->subposition => $subposition],
            'pluginOptions'=>[
            'depends'=>[Html::getInputId($model, "position")], // the id for cat attribute
            'placeholder'=>'- - -',
            'url'=>Url::to(['/control/primary-products/subposition'])
                ]
            ]);?>
    </div>
    <div class="col-md-6 col-lg-3">
        <?= $form->field($model, "year_amount")->textInput(['type' => 'number']) ?>
    </div>
    <div class="col-md-6 col-lg-3">
        <?= $form->field($model, "year_quantity")->widget(MaskMoney::classname(), [
            'pluginOptions' => [
            'prefix' => 'SUMMA : ',
            'suffix' => ' so\'m',
            'allowNegative' => false
            ]
        ]);  ?>
    </div>
    <div class="col-md-6 col-lg-3">
        <?= $form->field($model, "residue_amount")->textInput(['type' => 'number']) ?>
    </div>
    <div class="col-md-6 col-lg-3">
        <?= $form->field($model, "residue_quantity")->widget(MaskMoney::classname(), [
            'pluginOptions' => [
            'prefix' => 'SUMMA : ',
            'suffix' => ' so\'m',
            'allowNegative' => false ]
        ]); ?>
    </div>

    <div class="col-md-6 col-lg-6" >
    <h5 style="color:black;">Mahsulotga oid texnik reglament yoki standartlar</h5>
                    <?php DynamicFormWidget::begin([
                        'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                        'widgetBody' => '.container-items', // required: css class selector
                        'widgetItem' => '.item', // required: css class
//                        'limit' => 7, // the maximum times, an element can be cloned (default 999)
                        'min' => 1, // 0 or 1 (default 1)
                        'insertButton' => '.add-item', // css class
                        'deleteButton' => '.remove-item', // css class
                        'model' => $nds[0],
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
                        foreach ($nds as $i => $stan):
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
                                        <div class="col-md-6 col-lg-6" id="titleOv">
                                            <?= $form->field($stan, "[{$i}]type_id")->dropDownList(ArrayHelper::map(NdType::find()->all(), 'id', 'name')) ?>
                                        </div>
                                        <div class="col-md-6 col-lg-6">
                                            <?= $form->field($stan, "[{$i}]name")->textInput() ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <?php DynamicFormWidget::end(); ?>
    </div>
    <div class="col-md-6 col-lg-3">
        <?= $form->field($model, "codetnved")->widget(MaskedInput::className(), [
            'mask' => '999999999' ]) ?>
    </div>
    <div class="col-md-6 col-lg-3">
        <?= $form->field($model, "potency")->textInput() ?>
    </div>
    <div class = "row" style = "font-size: 18px; font-weight: bold;">
        <div class="col-md-6 col-lg-3">
            <?= $form->field($model, "labaratory_checking")->radioList( [1=>'taqdim etilgan', 0 => 'taqdim etilmagan'] );?>
        </div>
        <div class="col-md-6 col-lg-3" >
            <?= $form->field($model, "certification")->radioList( [1=>'ha', 0 => 'yo\'q'], );?>
        </div>
        <div class="col-md-6 col-lg-3">
            <?= $form->field($model, "photo")->fileInput() ?>
        </div>
        <div class="col-md-6 col-lg-3">
            <?= $form->field($model, "exsist_certificate")->radioList( [1=>'mavjud', 0 => 'mavjud emas'],['onclick' => "typeChange(event,this)",] );?>
        </div>
    </div>

    <div class="col-md-6 col-lg-9  renderForm certificate" style="display:none;">
    <h5 style="color:black;">Mahsulot sertifikat(lar)i</h5>
                    <?php DynamicFormWidget::begin([
                        'widgetContainer' => 'dynamicform_wrapper1', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                        'widgetBody' => '.container-items1', // required: css class selector
                        'widgetItem' => '.item1', // required: css class
//                        'limit' => 7, // the maximum times, an element can be cloned (default 999)
                        'min' => 1, // 0 or 1 (default 1)
                        'insertButton' => '.add-item1', // css class
                        'deleteButton' => '.remove-item1', // css class
                        'model' => $cers[0],
                        'formId' => 'dynamic-form',
                        'formFields' => [
                            'type',
                            'measurement',
                            'compared',
                            'invalid',
                        ],
                    ]); ?>
                <div class="container-items1">        
                        <?php
                        foreach ($cers as $i => $stan):
                            if ($i == 1) {
                                continue;
                            } ?>
                            <div class="item1 panel panel-default item-product itemlar"  >
                                <div class="panel-heading" >
                                    <div class="pull-right">
                                        <button type="button" class="add-item1 btn btn-success btn-xs">
                                            <i class="fa fa-plus"></i></button>
                                        <button type="button" class="remove-item1 btn btn-danger btn-xs" id="removeBtn">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="row ">
                                        <div class="col-md-6 col-lg-4" id="titleOv">
                                            <?= $form->field($stan, "[{$i}]number_reestr")->textInput(['type'=>'number']) ?>
                                        </div>
                                        <div class="col-md-6 col-lg-4">
                                            <?= $form->field($stan, "[{$i}]date_to")->textInput(['type'=>'date']) ?>
                                        </div>
                                        <div class="col-md-6 col-lg-4">
                                            <?= $form->field($stan, "[{$i}]date_from")->textInput(['type'=>'date']) ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <?php DynamicFormWidget::end(); ?>
    </div>
</div>   
    <div class="form-group">
        <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success']) ?>
    </div>
</div>
    <?php ActiveForm::end(); ?>
 
<script>
     function typeChange(e,t) {
        
        if (e.target.value == "1" && e.target.checked) {
            
        var collection =  document.getElementsByClassName("certificate");
        for (var i=0;i<collection.length;i++)
        {
            collection[i].style.display = 'block';
        }
        }
        if (e.target.value == "0" && e.target.checked) {
            let inputs = document.getElementsByClassName('certificate');
            for (let i = 0; i < inputs.length; i++) {
                inputs[i].style.display = 'none';
            }
        }
    }
    </script>
