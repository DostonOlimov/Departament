<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\govcontrol\Program $model */

$this->title = 'Update Program: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Programs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="program-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
