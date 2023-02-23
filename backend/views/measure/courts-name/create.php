<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\measure\CourtsName $model */

$this->title = 'Sud nomini yaratish';
$this->params['breadcrumbs'][] = ['label' => 'Sud nomi', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="courts-name-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
