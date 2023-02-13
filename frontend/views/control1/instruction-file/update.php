<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\control\InstructionFile $model */

$this->title = Yii::t('app', 'Update Instruction File: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Instruction Files'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="instruction-file-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
