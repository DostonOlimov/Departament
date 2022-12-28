<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\embargo\Embargo $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="embargo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'instructions_id')->textInput() ?>

    <?= $form->field($model, 'companies_id')->textInput() ?>

    <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'message_date')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'inspector_name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
