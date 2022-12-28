<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\prevention\Prevention $model */

$this->title = Yii::t('app', 'Create Prevention');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Preventions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prevention-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
