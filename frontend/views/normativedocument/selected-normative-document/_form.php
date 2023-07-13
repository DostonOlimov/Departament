<?php

use common\models\normativedocument\NormativeDocument;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\normativedocument\SelectedNormativeDocument $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="selected-normative-document-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'identification_id')->textInput() ?>

    <?= $form->field($model, 'normative_document')->widget(Select2::class, [
                'data' => NormativeDocument::getNormativeDocumentNames(),
                'language' => 'uz',
                'options' => ['multiple' => true],
                'showToggleAll' => false,
            ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
