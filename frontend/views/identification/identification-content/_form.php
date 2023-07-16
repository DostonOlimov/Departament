<?php

use common\models\identification\IdentificationContent;
use common\models\normativedocument\NormativeDocumentContent;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\identification\IdentificationContent $model */
/** @var yii\widgets\ActiveForm $form */

    $normative_document_content = NormativeDocumentContent::findOne($model->normative_document_content_id);
?>

<div class="identification-content-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'selected_normative_document_id')->textInput() ?>
    <?= $form->field($model, 'normative_document_content_id')->textInput() ?>
    
    <div class="row">    
        <div class="col-3">    
            <?= $form->field($model, 'name')->textInput([
                'value' => $normative_document_content->content,
                'readony' => true
                ]) ?>
            </div>

            <div class="col-3">    
                <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>
            </div>
            
            <div class="col-3">    
            <?= $form->field($model, 'conformity')->dropDownList($model->getConformity()) ?>
            </div>

        </div>




    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
