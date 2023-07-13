<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\identification\IdentificationContent $model */

$this->title = 'Update Identification Content: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Identification Contents', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="identification-content-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
