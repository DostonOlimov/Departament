<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\control\PrimaryProduct $model */

$this->title = 'Mahsulot qo\'shish';
$this->params['breadcrumbs'][] = ['label' => 'Primary Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="primary-product-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
