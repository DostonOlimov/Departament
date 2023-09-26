<?php

use common\models\identification\IdentificationContent;
use common\models\LocalActiveRecord;
use common\models\normativedocument\NormativeDocumentContent;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\identification\IdentificationContentSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Tashqi ko\'rinish bayonnomasi';
$this->params['breadcrumbs'][] = $this->title;
// debug($dataProvider->getModels());
// debug(Yii::$app->request->referrer);
?>
<style>
  h2 {
    text-align: center;
    }
</style>
<div class="identification-content-index container">


<h2>
    <?= $dataProvider->getModels()[0]->company->company_name."dan sinash uchun olingan na`munalarni sezgi a'zolari orqali (tashqi ko‘rikdan o‘tkazish, tamg‘alash,  qadoqlash va saqlash) tekshirish
<br>B A Y O N N O M A S I"
?>
    </h2>
<?= Html::a('Ortga', Yii::$app->request->referrer, ['class' => 'btn btn-info'])?><br>

    <h3>
        Mahsulot nomi: <?= $dataProvider->getModels()[0]->selectedProduct->name?>
        </h3>

    <p>

    <?php if ($identification) :?>
        
        <?php if ($identification->status == LocalActiveRecord::DOCUMENT_STATUS_CONFIRMED) :?>
            <?php  // echo Html::a('Qo\'shish', ['create'], ['class' => 'btn btn-success']) ?>
            <?= Html::a('Yuklab olish', ['govcontrol/gov-control/identification-document', 'id' => $dataProvider->getModels()[0]->identification->id], ['class' => 'btn btn-info']) ?>
        <?php endif ?>
        <?php if ($dataProvider->models[0]->selectedNormativeDocument->status === LocalActiveRecord::DOCUMENT_STATUS_INPROGRESS) :?>
            <?= Html::a('Yakunlash', ['normativedocument/selected-normative-document/change-status',
                'id' => $dataProvider->models[0]->selectedNormativeDocument->id, 
                'status' => LocalActiveRecord::DOCUMENT_STATUS_CONFIRMED
                ], ['class' => 'btn btn-info']) ?>
        <?php endif ?>

    <?php endif ?>
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
            // [
            //     'attribute' => 'identification_id',
            //     'value' => 'identification.id',
            // ],
            [
                'attribute' => 'selected_normative_document_id',
                // 'label' => 'Me\'yoriy hujjat nomi',
                'value' => function($model){
                    if($model->normativeDocument){
                        $result = $model->normativeDocument->determination;
                        if($model->normativeDocumentSection){
                            $result = $result.' '.$model->normativeDocumentSection->section_number.' '.
                            $model->normativeDocumentSection->section_name;
                        }
                        return $result;
                    }      
                    else {
                        return '';              
                    }
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
            // 'conformity',
            [
                'attribute' => 'conformity',
                'value' => function($model){
                    if($model->conformity !== null){
                        return $model->getConformity($model->conformity);
                    }
                    else return '-';
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
