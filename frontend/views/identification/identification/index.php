<?php

use common\models\identification\Identification;
use frontend\widgets\StepsGovControl;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\identification\IdentificationSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Identifications';
$this->params['breadcrumbs'][] = $this->title;
// debug($dataProvider->getModels());
?>
<div class="identification-index row">

<div class="col-3 mt-5">
            <?php echo StepsGovControl::widget([
                'gov_control_order_id' => $gov_control_order_id
                ])?>
    </div>
    <div class="col-5 mt-5">

    <p>
        <?= Html::a('Create Identification', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'headerRowOptions' => ['style' => 'background-color: #0072B5'], 
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            // 'status',
            // 'actSelection.gov_control_order_id',
            [
                'attribute' => 'status',
                'value' => function($model){
                    if($model->status){
                        return $model->getDocumentStatus($model->status);
                    }
                    return "No'malum";
                }
            ],
            // 'selected_product_id',
            'selectedProduct.name',
            [
                'class' => ActionColumn::class,
                'template' => '{view}',
                'buttonOptions' => ['class' => 'text-primary'],
                'urlCreator' => function ($action, Identification $model, $key, $index, $column) {
                    // debug($model);
                    if($model->status == $model::DOCUMENT_STATUS_INPROGRESS){
                        return Url::toRoute(['identification-view', 'id' => $model->id]);
                    }
                    return '';
                 }
            ],
        ],
    ]); ?>

    </div>
</div>
