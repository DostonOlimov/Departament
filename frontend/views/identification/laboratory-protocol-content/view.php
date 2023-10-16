<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\identification\LaboratoryProtocolContent $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Laboratory Protocol Contents', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="laboratory-protocol-content-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
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
            'laboratory_protocol_id',
            'normative_document_id',
            'indicator_name',
            'requirement_link',
            'requirement_range',
            'requirement_min',
            'requirement_max',
            'current_value',
            'unit_om',
        ],
    ]) ?>

</div>
