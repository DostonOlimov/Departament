<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\govcontrol\ProgramProperty $model */

$this->title = 'Create Program Property';
$this->params['breadcrumbs'][] = ['label' => 'Program Properties', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="program-property-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
