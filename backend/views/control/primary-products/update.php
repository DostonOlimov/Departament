<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\control\PrimaryProduct $model */

$this->title = 'Update Primary Product: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Primary Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="primary-product-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
