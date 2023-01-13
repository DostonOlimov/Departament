<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\measure\Economics $model */

$this->title = 'Create Economics';
$this->params['breadcrumbs'][] = ['label' => 'Economics', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="economics-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
