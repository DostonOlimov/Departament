<?php

use common\models\normativedocument\NormativeDocument;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\govcontrol\ProgramData $model */

$this->title = 'Create Program Data';
$this->params['breadcrumbs'][] = ['label' => 'Program Datas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="program-data-create">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
