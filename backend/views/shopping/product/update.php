<?php

/* @var $this yii\web\View */
/* @var $model Product */

use common\models\shopping\Product;
use frontend\widgets\StepsShopping;
use common\models\User;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\helpers\Html;

$this->title = 'Davlat nazoratini o\'tkazish uchun asos';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="product-update ">

   
<div class="container">
<?php $form = ActiveForm::begin([
            'id' => 'dynamic-form',
            'enableClientValidation' => false,
            'options' => [
                'enctype' => 'multipart/form-data',
            ]
        ]) ?>
         <?= $form->field($company, 'lab_comment')->Input(['maxlength' => true]) ?>
            <h3 style="color:black;display:inline;">Mahsulotlar </h3>
                <hr>
    <div class="row" id="content2"  >
        <div class="box box-default" style="display: inline-block">
           
            <div class="panel-body">
                <?php DynamicFormWidget::begin([
                    'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                    'widgetBody' => '.container-items', // required: css class selector
                    'widgetItem' => '.item', // required: css class
                    'limit' => 4, // the maximum times, an element can be cloned (default 999)
                    'min' => 1, // 0 or 1 (default 1)
                    // 'insertButton' => '.add-item', // css class
                    // 'deleteButton' => '.remove-item', // css class
                    'model' => $products[0],
                    'formId' => 'dynamic-form',
                    'formFields' => [
                        'name',
                        'company_id',
                        'quantity',
                        'cost',
                        'created_by',                        
                    ],
                ]); ?>

<div class="container-items"><!-- widgetContainer -->
                <?php foreach ($products as $i => $products): ?>
                    <div class="item panel panel-default"><!-- widgetBody -->
                        <div class="panel-heading">
                            <!-- <div class="pull-right">
                                <button type="button" class="add-item btn btn-success btn-xs"><i class="fa fa-plus"></i></button>
                                <button type="button" class="remove-item btn btn-danger btn-xs"><i class="fa fa-minus"></i></button>
                            </div> -->
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-body">
                            
                            <div class="row">
                                <div class="col-sm-4">
                                    <?= $form->field($products, "[{$i}]name")->textInput()?>
                                </div>
                                <div class="col-sm-4">
                                    <?= $form->field($products, "[{$i}]sum")->textInput() ?>
                                </div>
                                <div class="col-sm-4">
                                    <?= $form->field($products, "[{$i}]quantity")->textInput()?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <?= $form->field($products, "[{$i}]production_date")->textInput(['type'=>'date'])?>
                                </div>
                                <div class="col-sm-4">
                                    <?= $form->field($products, "[{$i}]purchase_date")->textInput(['type'=>'date'])?>
                                </div>
                                <div class="col-sm-4">
                                    <?= $form->field($products, "[{$i}]product_lot")->textInput()?>
                                </div>
                            </div>
                            <div class="row">
                                
                                <div class="col-sm-4">
                                    <?= $form->field($products, "[{$i}]photo")->fileInput()?>
                                </div>
                                <div class="col-sm-4">
                                    <?= $form->field($products, "[{$i}]photo_chek")->fileInput()?>
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

    <div class="form-group">
        <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
                </div>
</div>


