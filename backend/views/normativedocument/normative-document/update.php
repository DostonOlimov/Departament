<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\normativedocument\NormativeDocument $model */

$this->title = 'Update Normative Document: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Normative Documents', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="normative-document-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
