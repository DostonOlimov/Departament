<?php

use common\models\normativedocument\NormativeDocumentContent;
use common\models\normativedocument\NormativeDocumentSection;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\normativedocument\NormativeDocumentContent $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="normative-document-content-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'parent_id')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'section')->textInput(['readonly' => true]) ?>
    
    <?= $form->field($model, 'document_section_id')->textInput(['readonly' => true]) ?>

    <?php if($model->parent_id){
        echo $form->field($model, 'parent_name')->textInput(
            [
                'value' => NormativeDocumentContent::findOne($model->parent_id)->content ?? '',
                'readonly' => true
            ]); 
    }
        ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'position')->hiddenInput()->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
