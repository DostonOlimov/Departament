<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\shopping\ShoppingLaboratory $model */

$this->title = Yii::t('app', 'Create Shopping Laboratory');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Shopping Laboratories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shopping-laboratory-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
