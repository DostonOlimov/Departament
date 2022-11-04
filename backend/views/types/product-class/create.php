<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\types\ProductClass $model */

$this->title = 'Create Product Class';
$this->params['breadcrumbs'][] = ['label' => 'Product Classes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-class-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
