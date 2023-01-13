<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\measure\Executions $model */

$this->title = 'Create Executions';
$this->params['breadcrumbs'][] = ['label' => 'Executions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="executions-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
