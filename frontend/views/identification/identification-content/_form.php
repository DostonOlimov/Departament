<?php

use common\models\identification\IdentificationContent;
use common\models\normativedocument\NormativeDocumentContent;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\identification\IdentificationContent $model */
/** @var yii\widgets\ActiveForm $form */

    $normative_document_content = NormativeDocumentContent::findOne($model->normative_document_content_id);
    $action = Yii::$app->controller->action->id;
    // debug($action);
?>

<div class="identification-content-form">

    <?php $form = ActiveForm::begin(); ?>
    <?php if($action <> 'update'){?>
        <?= $form->field($model, 'selected_normative_document_id')->textInput() ?>
        <?= $form->field($model, 'normative_document_content_id')->textInput() ?>
    <?php }else {?>
        <?= $form->field($model, 'selected_normative_document_id')->hiddenInput()->label(false) ?>
        <?= $form->field($model, 'normative_document_content_id')->hiddenInput()->label(false) ?>
        
        <?php } ?>

    <div class="row">
        <div class="col-3">    
                <?= $form->field($model, 'section_name')->textarea([
                    'rows' => 10,
                    'value' => $normative_document_content->section_name,
                    'readony' => true
                    ]) ?>
        </div>    
        <div class="col-3">    
            <?= $form->field($model, 'name')->textarea([
                'rows' => 10,
                'value' => $normative_document_content->content,
                'readony' => true
                ]) ?>
            </div>

            <div class="col-3">    
                <?= $form->field($model, 'comment')->textarea(['rows' => 10]) ?>
            </div>
            
            <div class="col-3">    
            <?= $form->field($model, 'conformity')->dropDownList($model->getConformity()) ?>
            </div>

        </div>




    <div class="form-group">
        <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
