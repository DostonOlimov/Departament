<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\actselection\ActSelection $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Act Selections', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
$add_button = false;
?>
<div class="act-selection-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
    <?= Html::a('Ortga', ['actselection/act-selection/index', 'gov_control_order_id' => $model->gov_control_order_id], ['class' => 'btn btn-info']) ?>
            <?php if ($model->status <> $model::DOCUMENT_STATUS_CONFIRMED) : ?>
                <?= Html::a('Tasdiqlash', ['change-status', 'id' => $model->id, 'status' => $model::DOCUMENT_STATUS_CONFIRMED], ['class' => 'btn btn-info']) ?>
                <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this item?',
                            'method' => 'post',
                        ],
                    ]) ?>
                <?php $add_button = true ?>
            <?php endif ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'gov_control_order_id',
            'warehouse_name',
            'warehouse_address',
            [
                'attribute' => 'status',
                'value' => function($model){
                    switch ($model->status) {

                        case $model::DOCUMENT_STATUS_CONFIRMED:
                            return '<span class="badge badge-pill badge-success">' . $model->getDocumentStatus($model->status) . '</span><br>';
                            break;
                        
                        case $model::DOCUMENT_STATUS_INPROGRESS:
                            return '<span class="badge badge-pill badge-secondary">' . $model->getDocumentStatus($model->status) . '</span><br>';
                            break;
                            
                        case $model::DOCUMENT_STATUS_NEW:
                            return '<span class="badge badge-pill badge-warning">' . $model->getDocumentStatus($model->status) . '</span><br>';
                            break;
                            
                        default:
                            return ($model->status) ? $model->getDocumentStatus($model->status) : $model->status;
                    }
                },
                'format' => 'raw',   
            ],
            'created_at',
            'updated_at'
        ],
    ]) ?>
    <?= $this->render('/actselection/selected-product/index', compact(
            'model',
            'searchModel',
            'dataProvider',
            'add_button'

        )); ?>

</div>
