<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\types\ProductClass $model */

$this->title = 'Update Product Class: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Product Classes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="product-class-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
