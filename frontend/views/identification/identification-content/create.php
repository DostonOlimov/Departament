<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\identification\IdentificationContent $model */

$this->title = 'Create Identification Content';
$this->params['breadcrumbs'][] = ['label' => 'Identification Contents', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php $form = ActiveForm::begin(); ?>
<div class="identification-content-create container">

   <div class="row">
       <?php foreach ( $model as $key => $value) :  ?>
        <?= $form->field($value, "[{$key}]selected_normative_document_id")->hiddenInput()->label(false) ?>
        <?= $form->field($value, "[{$key}]normative_document_content_id")->hiddenInput()->label(false) ?>
    <div class="col-3">    
        <?= $form->field($value, "[{$key}]name")->textArea(['readonly' => true]) ?>
        <?= $form->field($value, "[{$key}]status")->checkbox([
            // 'label' => $value->name,
            'label' => '',
            'checked' => false,
            'uncheck' => 0,
        ]); ?>
    </div>
    <div class="col-3">    
        <?= $form->field($value, "[{$key}]comment")->textInput() ?>
    </div>
    <div class="col-3">    
        <?= $form->field($value, "[{$key}]conformity")->dropDownList($value->getConformity()) ?>
    </div>
    <?php endforeach; ?>
    <div class="form-group">
    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
    </div>
    <?php ActiveForm::end(); ?>
    
    </div>
    
    
    

   
   
