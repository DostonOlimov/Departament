<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\identification\LaboratoryProtocol $model */

$this->title = 'Update Laboratory Protocol: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Laboratory Protocols', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="laboratory-protocol-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
