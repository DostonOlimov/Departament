<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\RisksCriteria $model */

$this->title = 'Update Risks Criteria: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Risks Criterias', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="risks-criteria-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
