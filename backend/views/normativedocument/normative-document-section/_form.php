<?php

use common\models\normativedocument\NormativeDocument;
use common\models\normativedocument\NormativeDocumentSection;
use PhpOffice\PhpSpreadsheet\Calculation\Information\Value;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\normativedocument\NormativeDocumentSection $model */
/** @var yii\widgets\ActiveForm $form */
$old = NormativeDocumentSection::find()
->where(['normative_document_id' => $model->normative_document_id])
->select('section_category_id')
->asArray()
->all();
$keysToDelete = [];
foreach($old as $key => $value){
    // debug($value);
    $keysToDelete[$key] = $value['section_category_id'];
}
// debug($keysToDelete);
// die;
?>

<div class="normative-document-section-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'normative_document_id')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'section_category_id')->dropDownList($model->getSectionDropDown($keysToDelete)) ?>

    <?= $form->field($model, 'section_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'section_name')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
