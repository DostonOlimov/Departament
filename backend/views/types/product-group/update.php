<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\types\ProductGroup $model */

$this->title = 'Update Product Group: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Product Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="product-group-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
