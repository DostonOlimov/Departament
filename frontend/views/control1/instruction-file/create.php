<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\control\InstructionFile $model */

$this->title = Yii::t('app', 'Create Instruction File');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Instruction Files'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="instruction-file-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
