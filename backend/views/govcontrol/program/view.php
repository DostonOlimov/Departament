<?php

use common\models\Company;
use common\models\govcontrol\Program;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\govcontrol\Program $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Programs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="program-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        
        <?php if ($model->status <> $model::DOCUMENT_STATUS_CONFIRMED):?>
            <?= Html::a('Yangilash', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?php endif ?>
            
        <?php if ($model->status == $model::DOCUMENT_STATUS_SENT):?>
            <?= Html::a('Buyrug\' yaratish', ['govcontrol/order/create', 'gov_control_program_id' => $model->id], ['class' => 'btn btn-success']) ?>
            <?= Html::a('Tasqidlash', ['view', 'id' => $model->id, 'status' => $model::DOCUMENT_STATUS_CONFIRMED], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Tahrirlashga qaytarish', ['view', 'id' => $model->id, 'status' => $model::DOCUMENT_STATUS_RETURNED], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Rad etish', ['view', 'id' => $model->id, 'status' => $model::DOCUMENT_STATUS_DENIED], ['class' => 'btn btn-danger']) ?>
            <?php endif ?>
        <?php if ($model->status == $model::DOCUMENT_STATUS_NEW):?>
            <?= Html::a('O\'chirish', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                    ],
                    ]) ?>
        <?php endif ?>
        <?php if ($model->status == $model::DOCUMENT_STATUS_RETURNED):?>
            <?= Html::a('O\'chirish', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                    ],
                    ]) ?>
            <?php endif ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'company_id',
                'value' => function($model){
                    return Company::findOne($model->company_id)->company_name;
                }
            ],
            [
                'attribute' => 'company_type_id',
                'value' => function($model){
                    return $model->getCompanyType($model->company_type_id);
                }
            ],
            
            [
                'attribute' => 'gov_control_type',
                'value' => function($model){
                    return $model->getGovcontrolType($model->gov_control_type);
                }
            ],
            [
                'attribute' => 'status',
                'value' => function(Program $model){
                    return $model->getDocumentStatus($model->status);
                }
            ],
        ],
    ]) ?>

</div>
