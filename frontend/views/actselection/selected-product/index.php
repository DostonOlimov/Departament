<?php

use common\models\actselection\SelectedProduct;
use common\models\Countries;
use frontend\controllers\actselection\SelectedProductController;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\actselection\SelectedProductSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

// $this->title = 'Selected Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="selected-product-index">

    <p>
        <h3>Tanlab olingan mahsulotlar</h3>
    </p>
    <p>
        <?= Html::a('Mahsulot qo\'shish', ['actselection/selected-product/create', 'act_selection_id' => $model->id], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'headerRowOptions' => ['style' => 'background-color: #0072B5'], 
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'act_selection_id',
            'name',
            'cnfea_code',
            'batch_number',
            [
                'attribute' => 'ctry_ogn_code',
                'value' => function(SelectedProduct $model){
                    return (Countries::findOne($model->ctry_ogn_code))?Countries::findOne($model->ctry_ogn_code)->name:'';
                } 
            ],
            // 'mfr_name',
            // 'mfr_id',
            // 'mfrd_date',
            [
                'attribute' => 'exptr_ctry_code',
                'value' => function(SelectedProduct $model){
                    if($model = Countries::findOne($model->exptr_ctry_code)){
                        return $model->name;
                    }
                    return '';
                } 
            ],
            // 'imptr_name',
            // 'imptr_id',
            // 'prod_netto',
            // 'xtra_value',
            // 'xtra_unit_om',
            // 'bar_code',
            [
                'class' => ActionColumn::class,
                'buttonOptions' => [
                    'class' => 'text-primary'
                ],
                'urlCreator' => function ($action, SelectedProduct $model) {
                    return Url::toRoute(['actselection/selected-product/'.$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
