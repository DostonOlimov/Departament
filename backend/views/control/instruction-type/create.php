<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\control\InstructionType $model */

$this->title = 'Create Instruction Type';
$this->params['breadcrumbs'][] = ['label' => 'Instruction Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="instruction-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
