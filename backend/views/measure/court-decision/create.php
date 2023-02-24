<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\measure\CourtDecision $model */

$this->title = 'Sud qarorini qo\'shish';
$this->params['breadcrumbs'][] = ['label' => 'Court Decisions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="court-decision-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
