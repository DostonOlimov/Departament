<?php

use yii\helpers\Html;
use common\models\control\Company;
use common\models\control\PrimaryData;
use frontend\widgets\Steps;
use common\models\NdType;
use common\models\control\PrimaryProduct;
use common\models\control\PrimaryProductNd;
use yii\widgets\MaskedInput;
use wbraganca\dynamicform\DynamicFormWidget;
use kartik\date\DatePicker;
use common\models\types\ProductSubposition;
use common\models\Countries;
use common\models\types\ProductClass;
use common\models\types\ProductGroup;
use common\models\types\ProductPosition;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use common\models\types\ProductSector;
use kartik\depdrop\DepDrop;
use kartik\money\MaskMoney;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var common\models\control\PrimaryProduct $model */

$this->title = 'Mahsulotni tahrirlash: ' . $model->product_name;
$this->params['breadcrumbs'][] = ['label' => 'Primary Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
$primaryData = PrimaryData::findOne(['id' => $primary_data_id]);
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
<div class="page1-1 row">
  <?= Steps::widget([
        'control_instruction_id' => Company::findOne($primaryData->control_company_id)->control_instruction_id,
        'control_company_id' => $primaryData->control_company_id,
    ]) ?>
    <div class="col-8">


    <h1 style="display:inline;"><?= Html::encode($this->title) ?></h1>
    <?= Html::a('Yopish', ['index', 'primary_data_id' => $primary_data_id], ['class' => 'btn btn-primary']) ?>
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
    <?php
        foreach ($nds as $i => $stan):?>
    <div class="row ">
        <?= $form->field($stan, "[{$i}]id")->hiddenInput()->label(false) ?>
            <div class="col-md-6 col-lg-6" id="titleOv">
                <?= $form->field($stan, "[{$i}]type_id")->dropDownList(ArrayHelper::map(NdType::find()->all(), 'id', 'name')) ?>
            </div>
            <div class="col-md-6 col-lg-6">
                <?= $form->field($stan, "[{$i}]name")->textInput() ?>
            </div>
    </div>
        <?php endforeach; ?>
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

    <div class="col-md-6 col-lg-9  renderForm certificate">
    <h5 style="color:black;">Mahsulot sertifikat(lar)i</h5>      
                        <?php
                        if($cers){
                        foreach ($cers as $i => $stan):
                            if ($i == 1) {
                                continue;
                            } ?>
            <?= $form->field($stan, "[{$i}]id")->hiddenInput()->label(false) ?>
            <div class="row ">
                <div class="col-md-6 col-lg-4" id="titleOv">
                    <?= $form->field($stan, "[{$i}]number_reestr")->textInput(['type'=>'number']) ?>
                </div>
                <div class="col-md-6 col-lg-4">
                    <?= $form->field($stan, "[{$i}]date_to")->widget(DatePicker::className()) ?>
                </div>
                <div class="col-md-6 col-lg-4">
                    <?= $form->field($stan, "[{$i}]date_from")->widget(DatePicker::className()) ?>
                </div>
            </div>
                        <?php endforeach; } ?>
                    </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success']) ?>
    </div>
</div>
    <?php ActiveForm::end(); ?>
    </div>   
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



</div>
</div>
