<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\types\ProductSector $model */

$this->title = 'Create Product Sector';
$this->params['breadcrumbs'][] = ['label' => 'Product Sectors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-sector-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
