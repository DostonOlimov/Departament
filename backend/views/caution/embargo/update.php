<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\embargo\Embargo $model */

$this->title = Yii::t('app', 'Tahrirlash Taqiqlash ko\'rsatmasi: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Taqiqlash ko\'rsatmasi'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Tahrirlash');
?>
<div class="embargo-update">

   

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
