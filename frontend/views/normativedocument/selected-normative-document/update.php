<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\normativedocument\SelectedNormativeDocument $model */

$this->title = 'Update Selected Normative Document: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Selected Normative Documents', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="selected-normative-document-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
