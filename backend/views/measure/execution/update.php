<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\measure\Executions $model */

$this->title = 'Ma\' muriy bayonnomani tahrirlash: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Executions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="Ma\' muriy bayonnomani tahrirlash">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
