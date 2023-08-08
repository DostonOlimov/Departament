<?php

use common\models\normativedocument\NormativeDocument;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\normativedocument\SelectedNormativeDocument $model */
/** @var yii\widgets\ActiveForm $form */

// $nd = NormativeDocument::find($model->identification_id)
// ->select('id')
// ->asArray()
// ->all();
// debug($nd->id);
// debug($model);
?>

<div class="selected-normative-document-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'identification_id')->textInput() ?>

    <?= $form->field($model, 'normative_document_id')->widget(Select2::class, [
                'data' => NormativeDocument::getNormativeDocumentNames($model->identification_id),
                'language' => 'uz',
                'options' => ['multiple' => false, 'prompt' => 'Me\'yoriy hujjatni tanlang'],
                'showToggleAll' => false,
            ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
