<?php

use common\models\actselection\SelectedProduct;
use common\models\identification\IdentificationContent;
use frontend\controllers\actselection\SelectedProductController;
use frontend\widgets\StepsGovControl;
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
<div class="selected-product-index row">
    
    <?php // echo $this->render('_search', ['model' => $searchModel]); 
// $cont = 'actselection/selected-product/';
// debug($dataProvider->getModels()[0]);
?>
        <div class="col-3 mt-5">
            <?php echo StepsGovControl::widget([
                'gov_control_order_id' => $gov_control_order_id
                ])?>
    </div>
    <div class="col-5 mt-5">
        <p>
            <?php // echo Html::a('Mahsulot qo\'shish', ['actselection/selected-product/create', 'act_selection_id' => $model->id], ['class' => 'btn btn-success']) ?>
        </p>
        <h3>Tashqi ko'rinish bayonnomalari</h3>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'headerRowOptions' => ['style' => 'background-color: #0072B5'], 
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'act_selection_id',
            'name',
            'batch_number',
            'ctry_ogn_code',
            [
                'attribute' => 'identification.status',
                'label' => false,
                'value' => function($model){
                    if($model->identification){
                        if($model->identification->status){
                            return $model->getStatusSpan($model->identification->status);
                        }
                    }
                },
                'format' => 'raw',   
            ],
            //'mfr_name',
            //'mfr_id',
            //'mfrd_date',
            //'exptr_ctry_code',
            //'imptr_name',
            //'imptr_id',
            //'prod_netto',
            //'xtra_value',
            //'xtra_unit_om',
            //'cnfea_code',
            //'bar_code',
            [
                'class' => ActionColumn::class,
                
                'buttonOptions' => ['class' => 'text-primary'],

                'template' => '{view} {update}',
                'urlCreator' => function ($action, $model) {
                    $selected_normative_document_id = ($model->selectedNormativeDocuments)?$model->selectedNormativeDocuments[0]->id:null;

                    // debug($selected_normative_document_id);

                    $identification_content = IdentificationContent::find()->where(['selected_normative_document_id' => $selected_normative_document_id])->one();
                    // debug($identification_content);
                    // debug($action);
                    
                    if ($action === 'update') {
                        // debug($action);
                        return Url::toRoute(['actselection/selected-product/view', 'id' => $model->id]);
                    }
                    if ($action === 'view') {
                        // debug($action);
                        return ($identification_content) ? 
                            Url::toRoute(['identification/identification-content/index', 'identification_id' => $model->identification->id]) : 
                            Url::toRoute(['actselection/selected-product/view', 'id' => $model->id]);
                    }
                     }
                ]
            ],
        ],
    ); ?>


</div>
</div>
