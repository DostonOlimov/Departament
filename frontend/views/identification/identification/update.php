<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\identification\Identification $model */

$this->title = 'Update Identification: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Identifications', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="identification-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
