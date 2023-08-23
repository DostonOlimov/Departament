<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\govcontrol\ProgramProperty $model */

$this->title = 'Update Program Property: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Program Properties', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="program-property-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
