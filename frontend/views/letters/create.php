<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\caution\CautionLetters $model */

$this->title = 'Create Caution Letters';
$this->params['breadcrumbs'][] = ['label' => 'Caution Letters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="caution-letters-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
