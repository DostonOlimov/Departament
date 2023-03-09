<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\RiskAnalisysCriteria $model */

$this->title = 'Update Risk Analisys Criteria: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Risk Analisys Criterias', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="risk-analisys-criteria-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', compact('model')) ?>

</div>
