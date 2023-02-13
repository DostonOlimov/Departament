<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\control\DocumentAnalysis $model */

$this->title = 'Create Document Analysis';
$this->params['breadcrumbs'][] = ['label' => 'Document Analyses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="document-analysis-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
