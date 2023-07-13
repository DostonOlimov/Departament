<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\identification\Identification $model */

$this->title = 'Create Identification';
$this->params['breadcrumbs'][] = ['label' => 'Identifications', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="identification-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
