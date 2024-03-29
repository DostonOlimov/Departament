<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\govcontrol\Order $model */

$this->title = 'Tekshiruv buyrug\'ini yangilash: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="order-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'program' => $program,
    ]) ?>

</div>
