<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\normativedocument\NormativeDocument $model */

$this->title = 'Me\'yoriy hujjat yaratish';
$this->params['breadcrumbs'][] = ['label' => 'Normative Documents', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="normative-document-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
