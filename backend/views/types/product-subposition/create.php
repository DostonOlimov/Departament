<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\types\ProductSubposition $model */

$this->title = 'Create Product Subposition';
$this->params['breadcrumbs'][] = ['label' => 'Product Subpositions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-subposition-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
