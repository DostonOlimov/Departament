<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\normativedocument\SelectedNormativeDocument $model */

$this->title = 'Create Selected Normative Document';
$this->params['breadcrumbs'][] = ['label' => 'Selected Normative Documents', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="selected-normative-document-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
