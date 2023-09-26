<?php

use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

/** @var yii\web\View $this */
/** @var common\models\govcontrol\Order $model */

$this->title = 'Tekshiruvni tasdiqlash: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Confirm';
?>
<div class="order-update">

    <div class="order-form">

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'gov_control_program_id')->textInput(['readonly' => true]) ?>

<?= $form->field($model, 'order_prefix')->dropDownList($model->getGovControlPrefix(), ['prompt' => '', 'disabled'=>true]) ?>

<?= $form->field($model, 'order_number')->textInput() ?>

<?= $form->field($model, 'ombudsman_code_number')->widget(MaskedInput::class, ['mask' => '999-999-999']) ?>

<div class="form-group">
    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm::end(); ?>

</div>

</div>
