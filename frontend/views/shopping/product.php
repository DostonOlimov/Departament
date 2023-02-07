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

<div class="page1-1 row ">

    <?= StepsShopping::widget([
        // 'shopping_instruction_id' => $model->shoppingCompany->shopping_instruction_id,
        // 'shopping_company_id' => $model->shopping_company_id,
    ]) ?>

<?php $form = ActiveForm::begin([
            'id' => 'dynamic-form',
            'enableClientValidation' => false,
            'options' => [
                'enctype' => 'multipart/form-data',
            ]
        ]) ?>
    <i class="fa fa-toggle-right" id = "open2" onclick=openPanel2(); style="font-size:24px;color:blue;display:none;"></i> 
            <i class="fa fa-toggle-down " id = "close2" onclick=closePanel2(); style="font-size:24px;color:blue; " ></i> 
            <h3 style="color:black;display:inline;">Mahsulotlar qo'shish</h3>
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
                    'insertButton' => '.add-item', // css class
                    'deleteButton' => '.remove-item', // css class
                    'model' => $modelsPrevent[0],
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
                <?php foreach ($modelsPrevent as $i => $prevent): ?>
                    <div class="item panel panel-default"><!-- widgetBody -->
                        <div class="panel-heading">
                            <div class="pull-right">
                                <button type="button" class="add-item btn btn-success btn-xs"><i class="fa fa-plus"></i></button>
                                <button type="button" class="remove-item btn btn-danger btn-xs"><i class="fa fa-minus"></i></button>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-body">
                            
                            <div class="row">
                                <div class="col-sm-4">
                                    <?= $form->field($prevent, "[{$i}]name")->textInput()?>
                                </div>
                                <div class="col-sm-4">
                                    <?= $form->field($prevent, "[{$i}]sum")->textInput() ?>
                                </div>
                                <div class="col-sm-4">
                                    <?= $form->field($prevent, "[{$i}]quantity")->textInput()?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <?= $form->field($prevent, "[{$i}]production_date")->textInput(['type'=>'date'])?>
                                </div>
                                <div class="col-sm-4">
                                    <?= $form->field($prevent, "[{$i}]purchase_date")->textInput(['type'=>'date'])?>
                                </div>
                                <div class="col-sm-4">
                                    <?= $form->field($prevent, "[{$i}]product_lot")->textInput()?>
                                </div>
                            </div>
                            <div class="row">
                                
                                <div class="col-sm-4">
                                    <?= $form->field($prevent, "[{$i}]photo")->fileInput()?>
                                </div>
                                <div class="col-sm-4">
                                    <?= $form->field($prevent, "[{$i}]photo_chek")->fileInput()?>
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
        <?= Html::submitButton(Yii::t('app', 'Saqlash'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>


