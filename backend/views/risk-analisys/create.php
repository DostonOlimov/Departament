<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\RiskAnalisys $model */

$this->title = 'Create Risk Analisys';
$this->params['breadcrumbs'][] = ['label' => 'Risk Analisys', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="risk-analisys-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
