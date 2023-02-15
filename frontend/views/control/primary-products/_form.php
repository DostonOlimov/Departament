<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\control\PrimaryProduct;
use common\models\types\ProductSector;
use common\models\control\PrimaryProductNd;
use common\models\control\ControlProductCertification;
use common\models\Countries;
use kartik\depdrop\DepDrop;
use kartik\money\MaskMoney;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\widgets\MaskedInput;

/** @var yii\web\View $this */
/** @var common\models\control\PrimaryProduct $model */
/** @var yii\widgets\ActiveForm $form */
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
<h3>Yangi mahsulot qo'shish</h3>
<i class="fa fa-plus openPanel btn" id = "open" onclick=openPanel(); style="display:none;"></i> 
<i class="fa fa-minus closePanel btn" id = "close" onclick=closePanel();></i> 

<hr>
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
            'pluginOptions'=>[
            'depends'=>[Html::getInputId($model, "sector_id")], // the id for cat attribute
            'placeholder'=>'- - -',
            'url'=>Url::to(['/control/primary-products/group'])
                ]
        ]);?>
    </div>
    <div class="col-md-6 col-lg-3">
        <?= $form->field($model, "class")->widget(DepDrop::classname(), [
            'pluginOptions'=>[
            'depends'=>[Html::getInputId($model, "group")], // the id for cat attribute
            'placeholder'=>'- - -',
            'url'=>Url::to(['/control/primary-products/class'])
                ]
            ]);?>
    </div>
    <div class="col-md-6 col-lg-3">
        <?= $form->field($model, "position")->widget(DepDrop::classname(), [
            'pluginOptions'=>[
            'depends'=>[Html::getInputId($model, "class")], // the id for cat attribute
            'placeholder'=>'- - -',
            'url'=>Url::to(['/control/primary-products/position'])
                ]
            ]);?>
    </div>
    <div class="col-md-6 col-lg-3">
        <?= $form->field($model, "subposition")->widget(DepDrop::classname(), [
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
</div>   
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
</div>
    <?php ActiveForm::end(); ?>
    <script>
    function getProduct(e) {
        if(e.target.checked && e.target.value == 1)
        {
            var  item = document.getElementById('product');
            item.style.display = 'none';
        }
        if(e.target.checked && e.target.value == 0)
        {
            var  item = document.getElementById('product');
            item.style.display = 'flex'
        }
}
function openPanel() {

var  item1 = document.getElementById('open');
var  item2 = document.getElementById('close');
var item3 = document.getElementById('content');

item1.style.display = 'none';
item2.style.display = 'inline';
item3.style.display = 'flex';

}
function closePanel() {

var  item1 = document.getElementById('open');
var  item2 = document.getElementById('close');
var item3 = document.getElementById('content');

item1.style.display = 'inline';
item2.style.display = 'none';
item3.style.display = 'none'

}
</script>
