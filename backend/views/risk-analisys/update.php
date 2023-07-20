<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\RiskAnalisys $model */

$this->title = 'Update Risk Analisys: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Risk Analisys', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="risk-analisys-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
