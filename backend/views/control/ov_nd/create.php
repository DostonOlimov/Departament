<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\control\ControlPrimaryOvNd $model */

$this->title = 'Create Control Primary Ov Nd';
$this->params['breadcrumbs'][] = ['label' => 'Control Primary Ov Nds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="control-primary-ov-nd-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
