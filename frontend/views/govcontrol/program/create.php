<?php

use common\models\normativedocument\NormativeDocument;
use common\models\govcontrol\ProgramProperty;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\govcontrol\Program $model */

$this->title = 'Tekshiruv dasturi yaratish';
$this->params['breadcrumbs'][] = ['label' => 'Programs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="program-create">
    <?= $this->render('_form', [
        'model' => $model,
        'company' => $company,
    ]) ?>

</div>
