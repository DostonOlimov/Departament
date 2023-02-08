<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\shopping\ShoppingLaboratory $model */

$this->title = Yii::t('app', 'Update Shopping Laboratory: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Shopping Laboratories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="shopping-laboratory-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
