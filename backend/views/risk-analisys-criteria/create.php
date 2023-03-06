<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\RiskAnalisysCriteria $model */

$this->title = 'Xavf tahlili mezoni yaratish';
$this->params['breadcrumbs'][] = ['label' => 'RiskAnalisysCriteria', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="risk-analisys-criteria-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
