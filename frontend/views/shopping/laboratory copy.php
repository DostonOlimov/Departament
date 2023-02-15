<?php
use yii\helpers\Html;
use common\models\Region;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\helpers\ArrayHelper;
?>

<div class="customer-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($company, 'name')->textInput(['maxlength' => true]) ?>
            

    <?= $form->field($company, 'inn')->textInput(['maxlength' => true]) ?>

    <?= $form->field($company, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($company, 'region_id')->dropDownList(ArrayHelper::map(Region::find()->all(), 'id', 'name')) ?>

    <?= $form->field($company, 'after')->textInput() ?>

    <?= $form->field($company, 'address')->textInput() ?>
        </div>        
    </div>

    <div class="panel panel-default">
        <div class="panel-heading"><h4><i class="glyphicon glyphicon-envelope"></i> Addresses</h4></div>
        <div class="panel-body">
             <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.item', // required: css class
                'limit' => 4, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $products[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                    'full_name',
                    'address_line1',
                    'address_line2',
                    'city',
                    'state',
                    'postal_code',
                ],
            ]); ?>

            <div class="container-items"><!-- widgetContainer -->
            <?php foreach ($products as $i => $product): ?>
                <div class="item panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <h3 class="panel-title pull-left">Address</h3>
                        <div class="pull-right">
                            <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                            <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                       
                        
                    <div class="row">
                                <div class="col-sm-4">
                                    <?= $form->field($product, "[{$i}]shopping_company_id")->textInput()?>
                                </div>                                
                                <div class="col-sm-4">
                                    <?= $form->field($product, "[{$i}]name")->textInput()?>
                                </div>
                                <div class="col-sm-4">
                                    <?= $form->field($product, "[{$i}]sum")->textInput() ?>
                                </div>
                                <div class="col-sm-4">
                                    <?= $form->field($product, "[{$i}]quantity")->textInput()?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <?= $form->field($product, "[{$i}]production_date")->textInput(['type'=>'date'])?>
                                </div>
                                <div class="col-sm-4">
                                    <?= $form->field($product, "[{$i}]purchase_date")->textInput(['type'=>'date'])?>
                                </div>
                                <div class="col-sm-4">
                                    <?= $form->field($product, "[{$i}]product_lot")->textInput()?>
                                </div>
                            </div>
                            <div class="row">
                                
                                <div class="col-sm-4">
                                    <?= $form->field($product, "[{$i}]photo")->fileInput()?>
                                </div>
                                <div class="col-sm-4">
                                    <?= $form->field($product, "[{$i}]photo_chek")->fileInput()?>
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
        <?= Html::submitButton($product->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>