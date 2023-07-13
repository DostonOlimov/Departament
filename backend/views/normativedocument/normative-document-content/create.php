<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\normativedocument\NormativeDocumentContent $model */

$this->title = 'Me\'yoriy hujjat talabini yaratish';
$this->params['breadcrumbs'][] = ['label' => 'Normative Document Contents', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="normative-document-content-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
