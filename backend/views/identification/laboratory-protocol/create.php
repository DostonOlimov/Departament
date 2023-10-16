<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\identification\LaboratoryProtocol $model */

$this->title = 'Create Laboratory Protocol';
$this->params['breadcrumbs'][] = ['label' => 'Laboratory Protocols', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="laboratory-protocol-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
