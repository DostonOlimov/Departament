<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\actselection\SelectedProduct $model */

$this->title = 'Update Selected Product: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Selected Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="selected-product-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
