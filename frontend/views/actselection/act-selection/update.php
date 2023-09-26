<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\actselection\ActSelection $model */

$this->title = 'Update Act Selection: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Act Selections', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="act-selection-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="act-selection-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'gov_control_order_id')->textInput(['maxlength' => true, 'readonly' => true]) ?>
        </div>
        <div class="col-sm-6">
            <div class="form-group field-actselection-gov_control_order_id">
                <label class="control-label" for="actselection-gov_control_order_id">Holati</label>
                <input class="form-control" value=<?= $model->getDocumentStatus($model->status) ?> readonly="">
            </div>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'warehouse_name')->textInput() ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'warehouse_address')->textInput() ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Yaratish' : 'Yangilash', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

</div>
