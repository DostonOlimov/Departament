<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Region $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Hududlar', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="region-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Tahrirlash', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('O\'chirish', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            //'created_by',
           // 'updated_by',
            'created_at:date',
            'updated_at:date',
        ],
    ]) ?>

</div>
