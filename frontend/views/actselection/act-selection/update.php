<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\actselection\ActSelection $model */

$this->title = 'Update Act Selection: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Act Selections', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="act-selection-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'models' => $models,
    ]) ?>

</div>
