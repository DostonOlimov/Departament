<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\UnitOfMeasure $model */

$this->title = 'Create Unit Of Measure';
$this->params['breadcrumbs'][] = ['label' => 'Unit Of Measures', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="unit-of-measure-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
