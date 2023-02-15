<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\control\DocumentAnalysis $model */

$this->title = 'Update Document Analysis: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Document Analyses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="document-analysis-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
