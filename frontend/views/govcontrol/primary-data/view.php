<?php

use frontend\widgets\StepsGovControl;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\govcontrol\PrimaryData $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Primary Datas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="primary-data-view row">
<div class="col-3 mt-5">
        <?php echo StepsGovControl::widget(
            [
                'gov_control_order_id' => $model->gov_control_order_id,
            ]
            )?>
    </div>
        <div class="col-6 mt-5">

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
            [
                'attribute' => 'company_type_id',
                'value' => function($model){
                    return $model->getCompanyField($model->company_type_id);
                }
            ],
            'gov_control_order_id',
            'real_control_date_from',
            'real_control_date_to',
            [
                'attribute' => 'quality_management_system',
                'value' => function($model){
                    return $model->getObjectQMS($model->quality_management_system);
                }
            ],
            [
                'attribute' => 'product_exists',
                'value' => function($model){
                    return $model->getObjectProduct($model->product_exists);
                }
            ],
            [
                'attribute' => 'laboratory_exists',
                'value' => function($model){
                    return $model->getObjectLaboratory($model->laboratory_exists);
                }
            ],
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
            [
                'attribute' => 'measuring_and_testing_tools_exists',
                'value' => function($model){
                    return $model->getObjectMeasure($model->measuring_and_testing_tools_exists);
                }
            ],
            'last_gov_control_date',
            'last_gov_control_number',
            'comment:ntext',
        ],
    ]) ?>

</div>
</div>
