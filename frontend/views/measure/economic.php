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
        <div class="col-sm-6">
            <?= $form->field($model, 'first_warn_date')->textInput(['type' => 'date']) ?>
        </div>
        <div class="col-md-6 col-sm-12">
            <?= $form->field($model, 'warn_number')->textInput(['type'=>'number']) ?>
        </div>
        <div class="col-md-6 col-sm-12">
            <?= $form->field($model, 'eco_date')->textInput(['type'=>'date']) ?>
        </div>
        <div class="col-md-6 col-sm-12">
            <?= $form->field($model, 'eco_number')->textInput(['type'=>'number']) ?>
        </div>
        <div class="col-md-6 col-sm-12">
            <?= $form->field($model, 'eco_quantity')->textInput() ?>
        </div>
        <div class="col-md-6 col-sm-12">
            <?= $form->field($model, 'eco_amount')->textInput() ?>
        </div>
</div>
    <div class="col-12">
        <input type="submit" class="btn btn-info br-btn" value="Saqlash">
    </div>

    <?php ActiveForm::end() ?>

</div>