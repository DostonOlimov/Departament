<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\actselection\SelectedProduct $model */

$this->title = 'Create Selected Product';
$this->params['breadcrumbs'][] = ['label' => 'Selected Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="selected-product-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
