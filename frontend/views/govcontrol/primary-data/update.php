<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\govcontrol\PrimaryData $model */

$this->title = 'Update Primary Data: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Primary Datas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="primary-data-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
