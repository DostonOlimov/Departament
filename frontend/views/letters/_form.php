<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\caution\CautionLetters $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="caution-letters-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'company_id')->textInput() ?>

    <?= $form->field($model, 'letter_date')->textInput() ?>

    <?= $form->field($model, 'letter_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'upload_file')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'inpector_name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
