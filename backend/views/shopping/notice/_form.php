<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\shopping\ShoppingNotice $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="shopping-notice-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'notice_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'notice_sum')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'attachment_user_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
