<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\measure\Executions $model */

$this->title = 'Update Executions: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Executions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="executions-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
