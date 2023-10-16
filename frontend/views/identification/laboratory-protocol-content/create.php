<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\identification\LaboratoryProtocolContent $model */

$this->title = 'Sinov laboratoriyasi bayonnomasi ma\'lumotini qo\'shish';
$this->params['breadcrumbs'][] = ['label' => 'Laboratory Protocol Contents', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="laboratory-protocol-content-create">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php $form = ActiveForm::begin(); ?>
    <?= $this->render('_form', [
        'model' => $model,
        'form' => $form,
        'i' => null
    ]) ?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>


</div>
