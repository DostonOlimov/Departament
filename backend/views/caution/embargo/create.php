<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\embargo\Embargo $model */

$this->title = Yii::t('app', 'Create Embargo');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Embargos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="embargo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
