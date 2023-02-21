<?php 
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
?>
    <div class="col-sm-12 type">
        <?= $form->field($product[0], "[0]product_type")->radioList(['0'=>'ha','1'=>'yo\'q '], ['onclick' => "getProduct(event)" ,]); ?>
    </div>
    <div id = "product">   
        <i class="fa fa-toggle-right openPanel" id = "open3" onclick=openPanel3(); style="display:none;"></i> 
        <i class="fa fa-toggle-down closePanel " id = "close3" onclick=closePanel3();></i> 
        <h3>Tashkilotda tekshiruv davrida realizatsiya qilingan mahsulotlar haqida ma'lumot</h3>
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
                            'class',
                            'position',
                            'subposition',
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
                                </div>
                                <div class="panel-body">
                                    <div class="row">
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
                                            <?= $form->field($stan, "[{$i}]group")->widget(DepDrop::classname(), [
                                                'pluginOptions'=>[
                                                    'depends'=>[Html::getInputId($stan, "[{$i}]sector_id")], // the id for cat attribute
                                                    'placeholder'=>'- - -',
                                                    'url'=>Url::to(['/control/group'])
                                                ]
                                            ]);?>
                                        </div>
                                        <div class="col-md-6 col-lg-3">
                                            <?= $form->field($stan, "[{$i}]class")->widget(DepDrop::classname(), [
                                                'pluginOptions'=>[
                                                    'depends'=>[Html::getInputId($stan, "[{$i}]group")], // the id for cat attribute
                                                    'placeholder'=>'- - -',
                                                    'url'=>Url::to(['/control/class'])
                                                ]
                                            ]);?>
                                        </div>
                                        <div class="col-md-6 col-lg-3">
                                            <?= $form->field($stan, "[{$i}]position")->widget(DepDrop::classname(), [
                                                'pluginOptions'=>[
                                                    'depends'=>[Html::getInputId($stan, "[{$i}]class")], // the id for cat attribute
                                                    'placeholder'=>'- - -',
                                                    'url'=>Url::to(['/control/position'])
                                                ]
                                            ]);?>
                                        </div>
                                        <div class="col-md-6 col-lg-3">
                                            <?= $form->field($stan, "[{$i}]subposition")->widget(DepDrop::classname(), [

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
                                      <?= $form->field($stan, "[{$i}]codetnved")->widget(MaskedInput::className(), [
                                        'mask' => '999999999' ]) ?>
                                     </div>
                                        <div class="col-md-6 col-lg-3">
                                            <?= $form->field($stan, "[{$i}]residue_amount")->textInput(['type' => 'number']) ?>
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
                                            <?= $form->field($stan, "[{$i}]potency")->textInput() ?>
                                        </div>
                                    <div class = "row smallFont">
                                        <div class="col-md-6 col-lg-3">
                                             <?= $form->field($stan, "[{$i}]labaratory_checking")->radioList( [1=>'taqdim etilgan', 0 => 'taqdim etilmagan'] );?>
                                        </div>
                                        <div class="col-md-6 col-lg-3" >
                                            <?= $form->field($stan, "[{$i}]certification")->radioList( [1=>'ha', 0 => 'yo\'q'], );?>
                                        </div>
                                        <div class="col-md-6 col-lg-3">
                                        <?= $form->field($stan, "[{$i}]photo")->input('file') ?>
                                        </div>
                                        <div class="col-md-6 col-lg-3">
                                            <?= $form->field($stan, "[{$i}]exsist_certificate")->radioList( [1=>'mavjud', 0 => 'mavjud emas'],['onclick' => "typeChange(event,this)",] );?>
                                        </div>
                                    </div>
                                        <div class="col-md-6 col-lg-9  renderForm certificate" style="display:none;">
                                            <?= $this->render('_form_certification', [
                                                'form' => $form,
                                                'primaryIndex' => $i,
                                                'pro_cer' => !isset($pro_cer[$i]) ? [new ControlProductCertification] : $pro_cer[$i],
                                            ])
                                            ?>
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

