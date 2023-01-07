<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\caution\CautionLetters $model */

$this->title = 'Update Caution Letters: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Caution Letters', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="caution-letters-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
