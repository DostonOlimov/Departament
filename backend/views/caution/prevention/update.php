<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\prevention\Prevention $model */

$this->title = Yii::t('app', 'Ma\'lumotni tahrirlash: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Bartaraf etish ko\'rsatmasi'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Tahrirlash');
?>
<div class="prevention-update">

    

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
