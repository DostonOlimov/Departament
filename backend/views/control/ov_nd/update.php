<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\control\ControlPrimaryOvNd $model */

$this->title = 'Update Control Primary Ov Nd: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Control Primary Ov Nds', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="control-primary-ov-nd-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
