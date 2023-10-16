<?php

use common\models\identification\LaboratoryProtocolContent;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\identification\LaboratoryProtocolContentSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Sinov laboratoriyasi bayonnomasi ma\'lumotlari';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="laboratory-protocol-content-index">

    <h2><?= Html::encode($this->title) ?></h2>

    <p>
        <?= Html::a('Kamchilik qo\'shish', ['identification/laboratory-protocol-content/create', 'laboratory_protocol_id' => $model->id], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'headerRowOptions' => ['style' => 'background-color: #0072B5'], 
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'id',
                'value' => function(LaboratoryProtocolContent $model){
                    // debug($model);
                    return Html::a($model->id, ['/identification/laboratory-protocol-content/view', 'id' => $model->id], ['class' => 'text-primary']);
                },
                'format' => 'raw'
            ],
            // 'id',
            // 'laboratory_protocol_id',
            'normative_document_id',
            'indicator_name',
            'requirement_link',
            //'requirement_range',
            'requirement_min',
            'requirement_max',
            'current_value',
            // 'unit_om',
            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, LaboratoryProtocolContent $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
