<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $model Caution */


use common\models\control\Caution;
use common\models\control\Company;
use frontend\widgets\Steps;
use wbraganca\dynamicform\DynamicFormWidget;
use kartik\date\DatePicker;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;
use frontend\widgets\StepsReestr;

$this->title = 'Korxona';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="page1-1 row">
<div class="col-3">
<?= StepsReestr::widget([])?>
</div>
    <?php $form = ActiveForm::begin([
//        'enableClientValidation' => false,
//        'enableAjaxValidation' => true,
//        'validateOnChange' => true,
//        'validateOnBlur' => false,
        'options' => [
            'enctype' => 'multipart/form-data',
            'id' => 'dynamic-form'
        ]
    ]) ?>


    <div class="row">
        <div class="box box-default" style="display: inline-block">
            <div class="panel-body">
                <?php DynamicFormWidget::begin([
                    'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                    'widgetBody' => '.container-items', // required: css class selector
                    'widgetItem' => '.item', // required: css class
                        'limit' => 3, // the maximum times, an element can be cloned (default 999)
                    'min' => 1, // 0 or 1 (default 1)
                    'insertButton' => '.add-item', // css class
                    'deleteButton' => '.remove-item', // css class
                    'model' => $model[0],
                    'formId' => 'dynamic-form',
                    'formFields' => [
                        'file',
                        'caution_number',
                        'caution',
                        'file',
                        'caution_date',
                        'description',
                    ],
                ]); ?>

                <div class="container-items"><!-- widgetContainer -->
                    <?php foreach ($model as $i => $stan): ?>
                        <div class="item panel panel-default item-product"><!-- widgetBody -->
                            <div class="panel-heading">
                                <div class="pull-right">
                                    <button type="button" class="add-item btn btn-success btn-xs"><i
                                                class="fa fa-plus"></i></button>
                                    <button type="button" class="remove-item btn btn-danger btn-xs"><i
                                                class="fa fa-minus"></i></button>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                <div class="panel-body">
                <div class="row">
                <div class="col-md-12 col-lg-6">
                    <?= $form->field($stan, "[{$i}]person")->textInput(['style'=>"text-transform:uppercase"]) ?>
                </div>
                <div class="col-md-12 col-lg-6">
                    <?= $form->field($stan, "[{$i}]person_position")->textInput() ?>
                </div>
                <div class="col-md-12 col-lg-6">
                    <?= $form->field($stan, "[{$i}]number_passport")->widget(MaskedInput::className(), [
                        'mask' => 'AA9999999'
                    ]) ?>
                 </div>
                <div class="col-md-12 col-lg-6">
                    <?= $form->field($stan, "[{$i}]first_date")->widget(DatePicker::className(),['pluginOptions' => [
        'autoclose' => true,
        'format' => 'dd.mm.yyyy'
    ]])  ?>
                </div>
                <div class="col-md-12 col-lg-6">
                    <?= $form->field($stan, "[{$i}]fine_amount")->textInput() ?>
                </div>
                <div class="col-md-12 col-lg-6">
                    <?= $form->field($stan, "[{$i}]paid_amount")->textInput() ?>
                </div>
                <div class="col-md-12 col-lg-6">
                    <?= $form->field($stan, "[{$i}]caution_number")->textInput(['type'=>'number']) ?>
                </div>
                <div class="col-md-12 col-lg-6">
                    <div class = "row" id = "mjtk"  >
                        <label>MJtK moddasi</label>
                    <div class="col-sm-4">
                        <?= $form->field($stan, "[{$i}]m212")->dropDownList([0 => '- - -',1=>'1-qismi', 2 => '2-qismi',3=>'3-qismi',4=>'4-qismi'],);?>
                    </div>
                    <div class="col-sm-4">
                        <?= $form->field($stan, "[{$i}]m213")->dropDownList([0 => '- - -',1=>'1-qismi', 2 => '2-qismi']);?>
                    </div>
                    <div class="col-sm-4">
                        <?= $form->field($stan, "[{$i}]m214")->dropDownList([0 => '- - -',1=>'1-qismi', 2 => '2-qismi']);?>
                    </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-6"> 
                <table style="color:black;">
                <tr><td class = "label">Tushuntirish xati</td><td><?= $form->field($stan, "[{$i}]explanation_letter")->fileInput()->label(false) ?></td></tr>
                <tr><td class = "label">Talabnoma</td><td><?= $form->field($stan, "[{$i}]claim")->fileInput()->label(false) ?></td></tr>
                <tr><td class = "label">Sud xati</td><td><?= $form->field($stan, "[{$i}]court_letter")->fileInput()->label(false) ?></td></tr>
                </table>
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

    <div class="col-12">
        <input type="submit" class="btn btn-info br-btn" value="Saqlash">
    </div>

    <?php ActiveForm::end() ?>

</div>