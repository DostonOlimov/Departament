<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\types\ProductSector $model */

$this->title = 'Update Product Sector: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Product Sectors', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="product-sector-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
