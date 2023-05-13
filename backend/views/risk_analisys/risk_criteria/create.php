<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\RisksCriteria $model */

$this->title = 'Create Risks Criteria';
$this->params['breadcrumbs'][] = ['label' => 'Risks Criterias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="risks-criteria-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
