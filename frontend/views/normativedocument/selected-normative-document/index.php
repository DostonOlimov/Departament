<?php

use common\models\identification\IdentificationContent;
use common\models\normativedocument\NormativeDocument;
use common\models\normativedocument\SelectedNormativeDocument;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\normativedocument\SelectedNormativeDocumentSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Selected Normative Documents';
$this->params['breadcrumbs'][] = $this->title;
// debug($dataProvider);
?>
<div class="selected-normative-document-index">
    
<?php if(isset($button)){
    if($button <> $model::DOCUMENT_STATUS_CONFIRMED){?>
    <p>
        <?= Html::a('Me\'yoriy hujjat qo\'shish', ['/normativedocument/selected-normative-document/create', 'identification_id' => $identificationModel->id], ['class' => 'btn btn-primary']) ?>
    </p>    
<?php   }
}?>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'headerRowOptions' => ['style' => 'background-color: #0072B5'],  
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            // 'identification_id',
            [
                'attribute' => 'normative_document_id',
                'value' => function(SelectedNormativeDocument $model){
                    $document = NormativeDocument::findOne($model->normative_document_id);
                    // debug($document);
                    return $document->determination;
                }
            ],
            [
                'attribute' => 'status',
                'value' => function($model){
                    if($model->status){
                        return $model->getStatusSpan($model->status);
                    }
                },
                'format' => 'raw',   
            ],
            [
                'class' => ActionColumn::class,
                'template' => '{view}',

                'buttonOptions' => ['class' => 'text-primary',],
                
                'urlCreator' => function ($action, SelectedNormativeDocument $model) {
                    $identification_content = IdentificationContent::findOne(['selected_normative_document_id' => $model->id]);
                    if($identification_content){
                        return Url::toRoute(['identification/identification-content/index', 'id' => $model->id]);
                    }
                    else{
                        return Url::toRoute(['identification/identification-content/create', 'id' => $model->id]);
                    } 
                 }
            ],
            // 'normative_document_id',
        ],
    ]); ?>


</div>
