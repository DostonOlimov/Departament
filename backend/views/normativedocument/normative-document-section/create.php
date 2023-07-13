<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\normativedocument\NormativeDocumentSection $model */

$this->title = 'Me\'yoriy hujjat bobini yaratish';
$this->params['breadcrumbs'][] = ['label' => 'Normative Document Sections', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="normative-document-section-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
