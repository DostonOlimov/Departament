<?php

use common\models\normativedocument\NormativeDocument;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\identification\Identification $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="identification-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'selected_product_id')->textInput() ?>

    <?= $form->field($model, 'selected_normative_documents')->widget(Select2::class, [
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
