<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\measure\CourtsName $model */

$this->title = 'Sud nomini tahrirlash: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Courts Names', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="courts-name-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
