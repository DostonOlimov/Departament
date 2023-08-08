<?php

use common\models\actselection\SelectedProduct;
use common\models\identification\IdentificationContent;
use common\models\normativedocument\NormativeDocument;
use common\models\normativedocument\NormativeDocumentContent;
use common\models\normativedocument\NormativeDocumentSection;
use common\models\normativedocument\SelectedNormativeDocument;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\identification\IdentificationContentSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
// debug($dataProvider->getModels());
$this->title = 'Identification Contents';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="identification-view container">
<style>
  h2 {
    text-align: center;
    }
</style>
<?= Html::a('Ortga', ['govcontrol/gov-control/identification', 'gov_control_order_id' => $dataProvider->getModels()[0]->govControlOrder->id], ['class' => 'btn btn-info']) ?>


<h2>
    <?= $dataProvider->getModels()[0]->company->company_name."dan sinash uchun olingan na`munalarni sezgi a'zolari orqali (tashqi ko‘rikdan o‘tkazish, tamg‘alash,  qadoqlash va saqlash) tekshirish
<br>B A Y O N N O M A S I"
?>
    </h2>
    <h3>
        Mahsulot nomi: <?= $dataProvider->getModels()[0]->selectedProduct->name?>
        </h3>
        <br>

    <?= Html::a('Yuklab olish', ['govcontrol/gov-control/identification-document', 'id' => $dataProvider->getModels()[0]->selectedProduct->id], ['class' => 'btn btn-info']) ?>

    <p>
        <?php  // echo Html::a('Qo\'shish', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'headerRowOptions' => ['style' => 'background-color: #0072B5'],  
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            // 'selected_normative_document_id',
            [
                'attribute' => 'selected_normative_document_id',
                'value' => function(IdentificationContent $model){
                    $selected_normative_document = 
                    SelectedNormativeDocument::findOne(['id' => $model->selected_normative_document_id]);
                    $normative_document = NormativeDocument::findOne($selected_normative_document->normative_document_id);                
                    $normative_document_content = 
                    NormativeDocumentContent::findOne($model->normative_document_content_id);
                    $normative_document_section = 
                    NormativeDocumentSection::findOne($normative_document_content->document_section_id);                
                    return $normative_document->determination.' '.
                    $normative_document_section->section_number.' '.
                    $normative_document_section->section_name;
                }
                ],
            // 'normative_document_content_id',
            [
                'attribute' => 'normative_document_content_id',
                'value' => function(IdentificationContent $model){
                    $normative_document_content = NormativeDocumentContent::findOne($model->normative_document_content_id);
                    return $normative_document_content->content??'';
                }
            ],
            'comment:ntext',
            [
                'attribute' => 'conformity',
                'value' => function(IdentificationContent $model){
                    return $model->getConformity($model->conformity);
                }
            ],
            [
                'class' => ActionColumn::class,
                'template' => '{update}',
                'buttonOptions' => [
                    'class' => 'text-primary'
                ],
                'urlCreator' => function ($action, IdentificationContent $model, $key, $index, $column) {
                    return Url::toRoute(['identification/identification-content/'.$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
