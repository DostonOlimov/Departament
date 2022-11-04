<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\types\ProductPosition $model */

$this->title = 'Create Product Position';
$this->params['breadcrumbs'][] = ['label' => 'Product Positions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-position-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
